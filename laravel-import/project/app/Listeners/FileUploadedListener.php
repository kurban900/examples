<?php

namespace App\Listeners;

use App\Events\FileIsUploaded;
use App\Jobs\FileImportJob;

class FileUploadedListener
{
    public function handle(FileIsUploaded $event): void
    {
        dispatch(new FileImportJob($event->getFile()));
    }
}
