<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoomStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\MasterItem;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * GET /api/owner/dashboard
     * Ringkasan master data untuk Owner.
     * Modul sewa/inspeksi bisa menambahkan ringkasan miliknya di sini nanti.
     */
    public function owner(Request $request): JsonResponse
    {
        $counts = Room::toBase()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $roomsByStatus = collect(RoomStatus::cases())
            ->mapWithKeys(fn (RoomStatus $status) => [$status->value => (int) ($counts[$status->value] ?? 0)]);

        return response()->json([
            'user' => new UserResource($request->user()),
            'summary' => [
                'total_rooms' => $roomsByStatus->sum(),
                'rooms_by_status' => $roomsByStatus,
                'total_tenants' => User::tenants()->count(),
                'total_master_items' => MasterItem::count(),
            ],
        ]);
    }

    /**
     * GET /api/tenant/dashboard
     * Info kamar, hasil inspeksi, dan status deposit akan ditambahkan
     * oleh modul sewa/inspeksi (bagian teman).
     */
    public function tenant(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user()),
        ]);
    }
}
