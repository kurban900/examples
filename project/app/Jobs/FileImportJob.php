<?php

namespace App\Jobs;


use App\Services\Importer\ImportHandlerFactory;
use App\Services\Uploader\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Importer;


class FileImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private File $file)
    {
    }

    public function handle(Importer $importer): void
    {
        ImportHandlerFactory::import($this->file, $importer);
    }
}
