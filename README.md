# KosAudit

KosAudit is a Laravel demo application for managing boarding-house rooms,
tenants, inspections, rental contracts, and deposit reviews.

## Our Team

ALAN FELIX BAGUS YARDUN RICHARD

## Run locally

Requirements: PHP 8.2 or newer and Composer.

1. Install PHP dependencies:

   ```powershell
   composer install
   ```

2. Create the local environment file and application key:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

3. Create and seed the local database:

   ```powershell
   if (-not (Test-Path database\database.sqlite)) { New-Item -ItemType File database\database.sqlite }
   php artisan migrate --seed
   ```

4. Start the web server:

   ```powershell
   composer run dev
   ```

5. Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in a browser.

Seeded demo accounts use `owner@kosaudit.test` or `tenant@kosaudit.test` with
the password `password`. Room and tenant account pages and the dashboard
summary use the database. The tenant API currently exposes account profiles
only. Tenant portal, inspection, rental, and deposit screens remain
demonstration previews because those modules are not included in the backend
archive.

## API

The backend API is served by this Laravel app at `/api` and uses Sanctum bearer
tokens. Sign in at `POST /api/auth/login`; authenticated owner endpoints include
`/api/owner/dashboard`, `/api/owner/rooms`, `/api/owner/master-items`, and
`/api/owner/tenants`. Tenant accounts use `/api/tenant/dashboard`.

## Demo pages

- `/` — owner dashboard
- `/login` — demo login
- `/kamar` — rooms
- `/penghuni` — tenants
- `/sewa` — rental contracts
- `/inspeksi/form` — inspection
- `/inspeksi/komparasi` — inspection comparison
- `/deposit/perhitungan` — deposit calculation
- `/portal-penghuni` — tenant portal
- `/m/beranda`, `/m/kondisi`, `/m/deposit` — tenant mobile views
