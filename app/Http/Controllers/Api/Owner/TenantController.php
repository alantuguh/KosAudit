<?php

namespace App\Http\Controllers\Api\Owner;

use App\Enums\UserRole;
use App\Http\Controllers\Concerns\ResolvesPerPage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

/**
 * CRUD akun penghuni. Parameter {tenant} hanya bisa berisi user ber-role tenant
 * (lihat Route::bind di routes/api.php), jadi akun Owner tidak bisa diubah dari sini.
 */
class TenantController extends Controller
{
    use ResolvesPerPage;

    /**
     * GET /api/owner/tenants
     * Query: ?search=budi &per_page=15
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $search = $request->input('search');

        $tenants = User::tenants()
            ->when($request->filled('search'), function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate($this->perPage($request))
            ->withQueryString();

        return UserResource::collection($tenants);
    }

    /**
     * POST /api/owner/tenants
     */
    public function store(RegisterTenantRequest $request): JsonResponse
    {
        $tenant = User::create([
            ...$request->safe()->only(['name', 'email', 'phone', 'password']),
            'role' => UserRole::Tenant,
        ]);

        return (new UserResource($tenant))
            ->additional(['message' => 'Penghuni berhasil ditambahkan.'])
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * GET /api/owner/tenants/{tenant}
     */
    public function show(User $tenant): UserResource
    {
        return new UserResource($tenant);
    }

    /**
     * PUT/PATCH /api/owner/tenants/{tenant}
     * Jika password diganti, semua sesi login penghuni dicabut.
     */
    public function update(UpdateTenantRequest $request, User $tenant): UserResource
    {
        $data = $request->safe()->only(['name', 'email', 'phone', 'password']);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        DB::transaction(function () use ($tenant, $data) {
            $tenant->update($data);

            if (array_key_exists('password', $data)) {
                $tenant->tokens()->delete();
            }
        });

        return (new UserResource($tenant->refresh()))
            ->additional(['message' => 'Data penghuni berhasil diperbarui.']);
    }

    /**
     * DELETE /api/owner/tenants/{tenant}
     * Soft delete + cabut semua token agar penghuni langsung ter-logout.
     */
    public function destroy(User $tenant): JsonResponse
    {
        DB::transaction(function () use ($tenant) {
            $tenant->tokens()->delete();
            $tenant->delete();
        });

        return response()->json(['message' => 'Penghuni berhasil dihapus.']);
    }
}
