<?php

namespace Tests\Feature;

use App\Events\FileIsUploaded;
use App\Events\ImportCompleted;
use App\Events\ImportPartCompleted;
use App\Jobs\FileImportJob;
use App\Listeners\FileUploadedListener;
use App\Listeners\ImportPartListener;
use App\Models\Data;
use App\Services\Importer\Cache\DummyImportCache;
use App\Services\Importer\Import;
use App\Services\Importer\ImportHandler;
use App\Services\Uploader\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

use Tests\TestCase;

class ListenersTest extends TestCase
{

    public function testSuccess(): void
    {
        Event::fake();
        Event::assertListening(FileIsUploaded::class, FileUploadedListener::class);
        Event::assertListening(ImportPartCompleted::class, ImportPartListener::class);
    }
}
