<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Concerns\ResolvesPerPage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterItem\MasterItemRequest;
use App\Http\Resources\MasterItemResource;
use App\Models\MasterItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MasterItemController extends Controller
{
    use ResolvesPerPage;

    /**
     * GET /api/owner/master-items
     * Query: ?search=lam &per_page=15
     *        ?all=1  → semua item tanpa pagination (untuk dropdown/checkbox di form kamar)
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = MasterItem::query()
            ->withCount('rooms')
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%'.$request->input('search').'%'))
            ->orderBy('name');

        $items = $request->boolean('all')
            ? $query->get()
            : $query->paginate($this->perPage($request))->withQueryString();

        return MasterItemResource::collection($items);
    }

    /**
     * POST /api/owner/master-items
     */
    public function store(MasterItemRequest $request): JsonResponse
    {
        $item = MasterItem::create($request->validated());

        return (new MasterItemResource($item))
            ->additional(['message' => 'Item kondisi berhasil ditambahkan.'])
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * GET /api/owner/master-items/{master_item}
     */
    public function show(MasterItem $masterItem): MasterItemResource
    {
        return new MasterItemResource($masterItem->loadCount('rooms'));
    }

    /**
     * PUT/PATCH /api/owner/master-items/{master_item}
     */
    public function update(MasterItemRequest $request, MasterItem $masterItem): MasterItemResource
    {
        $masterItem->update($request->validated());

        return (new MasterItemResource($masterItem))
            ->additional(['message' => 'Item kondisi berhasil diperbarui.']);
    }

    /**
     * DELETE /api/owner/master-items/{master_item}
     * Soft delete: item hilang dari daftar kamar, tapi data inspeksi lama
     * yang merujuk item ini tetap utuh.
     */
    public function destroy(MasterItem $masterItem): JsonResponse
    {
        $masterItem->delete();

        return response()->json(['message' => 'Item kondisi berhasil dihapus.']);
    }
}
