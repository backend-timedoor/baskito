<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class APIDocController extends Controller
{
    /**
     * Register api doc endpoint
     *
     * @param  string  $filepath  the file path must be placed in public path
     * @param  bool|null  $enable  by default, it is disable in production
     * @return void
     */
    public static function registerRoute(string $filepath, ?bool $enable = null)
    {
        $enable = is_null($enable) ? (! App::environment('production')) : $enable;

        if ($enable) {
            Route::middleware('auth.basic')->get('/doc', function () use ($filepath) {
                $path  = $filepath;
                $title = 'API V1 Documentation';
                $file  = url($path).'?v='.md5_file(public_path($path));

                return view('api-doc', compact('title', 'file'));
            })->name('doc');
        }
    }
}
