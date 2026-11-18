#!/bin/sh
# ============================================================================
# Railway - Pre-Deploy Script
# Dijalankan otomatis oleh railway.json sebelum aplikasi menerima request.
#
# Catatan: Railpack sudah menangani composer install, npm build, migrasi,
# storage link, dan optimasi cache. Script ini hanya memastikan data awal
# terisi sekali pada deploy pertama dan cache disegarkan dengan variabel
# environment produksi yang benar-benar aktif saat runtime.
# ============================================================================
set -e

echo ">>> Menjalankan migrasi database (aman dijalankan berulang)..."
php artisan migrate --force

echo ">>> Mengisi data awal hanya jika database masih kosong..."
php artisan db:seed --class=RailwaySeeder --force

echo ">>> Membuat symlink storage (jika belum ada)..."
php artisan storage:link || true

echo ">>> Menyegarkan cache dengan environment produksi..."
php artisan optimize:clear
php artisan optimize

echo ">>> Pre-deploy selesai."
