<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cadangan jika header proxy tidak terbaca: paksa semua URL (termasuk
        // asset CSS/JS) memakai https ketika request datang lewat proxy HTTPS.
        if (request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

        // Laravel menyaring variabel lingkungan saat mode reload `php artisan serve`.
        // Di Windows, kunci $_ENV memakai huruf asli ("Path", "SystemRoot", dll.)
        // sehingga tidak cocok dengan daftar bawaan ("PATH", "SYSTEMROOT") dan
        // dihapus dari proses PHP anak. Tanpa PATH/SystemRoot, ekstensi curl gagal
        // dimuat ("Unable to start curl module"). Tambahkan variabel Windows di sini.
        ServeCommand::$passthroughVariables = array_values(array_unique(array_merge(
            ServeCommand::$passthroughVariables,
            [
                'Path',
                'SystemRoot',
                'windir',
                'ComSpec',
                'PATHEXT',
                'TEMP',
                'TMP',
                'APPDATA',
                'LOCALAPPDATA',
                'USERPROFILE',
                'HOMEDRIVE',
                'HOMEPATH',
                'ProgramData',
                'ProgramFiles',
                'ProgramFiles(x86)',
                'CommonProgramFiles',
                'CommonProgramFiles(x86)',
                'ProcessorArchitecture',
                'PROCESSOR_ARCHITECTURE',
            ]
        )));
    }
}
