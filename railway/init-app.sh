#!/bin/bash
# ============================================================================
# Railway - Pre-Deploy Script
# Dijalankan otomatis oleh railway.json sebelum aplikasi mulai melayani request.
# ============================================================================
set -e

echo ">>> Menjalankan migrasi database..."
php artisan migrate --force

echo ">>> Mengisi data awal (hanya jika database masih kosong)..."
php artisan db:seed --class=RailwaySeeder --force

echo ">>> Membuat symlink storage..."
php artisan storage:link || true

echo ">>> Membersihkan cache lama..."
php artisan optimize:clear

echo ">>> Meng-cache konfigurasi, route, event, dan view..."
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo ">>> Pre-deploy selesai."
