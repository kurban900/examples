<?php

namespace App\Listeners;

use App\Events\ImportPartCompleted;
use App\Jobs\FileImportJob;

class ImportPartListener
{
    public function handle(ImportPartCompleted $event): void
    {
        dispatch(new FileImportJob($event->getFile()));
    }
}
