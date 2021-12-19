<?php

namespace App\Providers;

use App\Services\Uploader\FileUploader;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app
            ->when(FileUploader::class)
            ->needs(Filesystem::class)
            ->give(static fn() => Storage::disk('docs'));
    }

    public function boot(): void
    {

    }
}
