<?php

namespace Tests\Feature;

use App\Events\FileIsUploaded;
use App\Events\ImportCompleted;
use App\Events\ImportPartCompleted;
use App\Jobs\FileImportJob;
use App\Listeners\FileUploadedListener;
use App\Models\Data;
use App\Services\Importer\Cache\DummyImportCache;
use App\Services\Importer\Import;
use App\Services\Importer\ImportHandler;
use App\Services\Uploader\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

use Tests\TestCase;

class FileUploadTest extends TestCase
{
    public function testSuccess(): void
    {
        Event::fake();
        Queue::fake();
        Storage::fake('docs');
        $file = UploadedFile::fake()->create('test.xlsx');

        $response = $this->post('/upload', [
            'file' => $file
        ]);

        $response->assertSessionHasNoErrors();
        Storage::disk('docs')->assertExists($file->hashName());
        Event::assertDispatched(FileIsUploaded::class);
    }
}
