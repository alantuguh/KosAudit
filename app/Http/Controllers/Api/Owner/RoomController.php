<?php

namespace App\Http\Controllers\Api\Owner;

use App\Enums\RoomStatus;
use App\Http\Controllers\Concerns\ResolvesPerPage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    use ResolvesPerPage;

    /**
     * GET /api/owner/rooms
     * Query: ?status=kosong &type=AC &search=10 &per_page=15
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $rooms = Room::query()
            ->withCount('masterItems')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->input('type')))
            ->when($request->filled('search'), fn ($q) => $q->where('room_number', 'like', '%'.$request->input('search').'%'))
            ->orderBy('room_number')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return RoomResource::collection($rooms);
    }

    /**
     * POST /api/owner/rooms
     */
    public function store(StoreRoomRequest $request): JsonResponse
    {
        $room = DB::transaction(function () use ($request) {
            $room = Room::create($request->safe()->except('items'));

            if ($request->has('items')) {
                $room->masterItems()->sync($this->pivotData($request->validated('items')));
            }

            return $room;
        });

        return (new RoomResource($room->load('masterItems')))
            ->additional(['message' => 'Kamar berhasil ditambahkan.'])
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * GET /api/owner/rooms/{room}
     */
    public function show(Room $room): RoomResource
    {
        return new RoomResource($room->load('masterItems'));
    }

    /**
     * PUT/PATCH /api/owner/rooms/{room}
     * Jika "items" dikirim, daftar item kamar diganti seluruhnya (sync).
     */
    public function update(UpdateRoomRequest $request, Room $room): RoomResource
    {
        DB::transaction(function () use ($request, $room) {
            $room->update($request->safe()->except('items'));

            if ($request->has('items')) {
                $room->masterItems()->sync($this->pivotData($request->validated('items')));
            }
        });

        return (new RoomResource($room->refresh()->load('masterItems')))
            ->additional(['message' => 'Kamar berhasil diperbarui.']);
    }

    /**
     * DELETE /api/owner/rooms/{room}
     * Soft delete: riwayat sewa/inspeksi lama tetap aman.
     */
    public function destroy(Room $room): JsonResponse
    {
        if ($room->status === RoomStatus::Occupied) {
            return response()->json([
                'message' => 'Kamar yang sedang terisi tidak bisa dihapus.',
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $room->delete();

        return response()->json(['message' => 'Kamar berhasil dihapus.']);
    }

    /**
     * [{master_item_id: 1, quantity: 2}] => [1 => ['quantity' => 2]]
     *
     * @param  array<int, array{master_item_id: int, quantity?: int|null}>  $items
     * @return array<int, array{quantity: int}>
     */
    private function pivotData(array $items): array
    {
        return collect($items)
            ->mapWithKeys(fn (array $item) => [
                (int) $item['master_item_id'] => ['quantity' => (int) ($item['quantity'] ?? 1)],
            ])
            ->all();
    }
}
