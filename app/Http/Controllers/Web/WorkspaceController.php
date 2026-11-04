<?php

namespace App\Http\Controllers\Web;

use App\Enums\RoomStatus;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Owner\RoomController as ApiRoomController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterTenantRequest;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Models\MasterItem;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class WorkspaceController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', 'in:owner,tenant'],
        ]);

        if (! Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ])) {
            throw ValidationException::withMessages([
                'email' => 'Email, password, atau jenis akun tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(
            $validated['role'] === 'tenant'
                ? route('portal.dashboard')
                : route('dashboard')
        );
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard(): View
    {
        $roomCounts = Room::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('dashboard.index', [
            'roomSummary' => [
                'total' => (int) $roomCounts->sum(),
                'occupied' => (int) ($roomCounts[RoomStatus::Occupied->value] ?? 0),
                'available' => (int) ($roomCounts[RoomStatus::Available->value] ?? 0),
                'repair' => (int) ($roomCounts[RoomStatus::NeedsRepair->value] ?? 0),
                'tenants' => User::tenants()->count(),
            ],
        ]);
    }

    public function rooms(): View
    {
        $rooms = Room::query()
            ->with('masterItems')
            ->orderBy('room_number')
            ->get()
            ->map(fn (Room $room) => [
                $room->room_number,
                (int) substr($room->room_number, 0, 1),
                $room->description ?: 'Kamar Kos',
                $this->roomTypeLabel($room->type),
                'Kapasitas standar',
                'Rp '.number_format($room->monthly_price, 0, ',', '.'),
                $room->masterItems->pluck('name')->implode(', ') ?: 'Belum ada item terdaftar',
                '- (Belum Ada)',
                'Belum ada kontrak sewa',
                match ($room->status) {
                    RoomStatus::Available => 'Kosong (Siap Huni)',
                    RoomStatus::Occupied => 'Terisi',
                    RoomStatus::NeedsRepair => 'Perbaikan',
                },
            ]);

        $masterItems = MasterItem::query()->orderBy('name')->get();
        $roomSummary = [
            'total' => Room::count(),
            'occupied' => Room::status(RoomStatus::Occupied)->count(),
            'available' => Room::status(RoomStatus::Available)->count(),
            'repair' => Room::status(RoomStatus::NeedsRepair)->count(),
        ];

        return view('kamar.index', compact('rooms', 'masterItems', 'roomSummary'));
    }

    public function storeRoom(StoreRoomRequest $request): RedirectResponse
    {
        app(ApiRoomController::class)->store($request);

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar '.$request->validated('room_number').' berhasil ditambahkan.');
    }

    public function room(string $number): View
    {
        $room = Room::query()
            ->with('masterItems')
            ->where('room_number', $number)
            ->firstOrFail();

        $kamar = [
            'nomor' => $room->room_number,
            'lantai' => substr($room->room_number, 0, 1),
            'tipe' => $this->roomTypeLabel($room->type),
            'ukuran' => 'Ukuran belum dicatat',
            'harga' => 'Rp '.number_format($room->monthly_price, 0, ',', '.'),
            'status' => match ($room->status) {
                RoomStatus::Available => 'Kosong (Siap Huni)',
                RoomStatus::Occupied => 'Terisi',
                RoomStatus::NeedsRepair => 'Butuh Perbaikan',
            },
            'penghuni' => 'Belum ada penghuni aktif',
            'periode' => 'Belum ada kontrak sewa',
            'deposit' => 'Belum ada data deposit',
            'fasilitas' => $room->masterItems->pluck('name')->all(),
        ];
        $riwayatInspeksi = [];

        return view('kamar.show', compact('kamar', 'riwayatInspeksi'));
    }

    public function tenants(): View
    {
        $penghuniList = User::tenants()
            ->orderBy('name')
            ->get()
            ->map(fn (User $tenant) => [
                'id' => $tenant->id,
                'nama' => $tenant->name,
                'email' => $tenant->email,
                'kamar' => null,
                'telepon' => $tenant->phone ?: 'Belum dicatat',
                'rekening' => 'Belum dicatat',
                'status' => 'Belum ada kontrak sewa',
            ]);

        return view('penghuni.index', compact('penghuniList'));
    }

    public function storeTenant(RegisterTenantRequest $request): RedirectResponse
    {
        app(AuthController::class)->register($request);

        return redirect()->route('penghuni.index')
            ->with('success', 'Akun penghuni '.$request->validated('name').' berhasil dibuat.');
    }

    private function roomTypeLabel(string $type): string
    {
        return match ($type) {
            'AC + KM Dalam' => 'Deluxe',
            'AC' => 'AC',
            default => $type,
        };
    }
}
