<?php

namespace Tests\Feature;

use App\Jobs\FileImportJob;
use App\Services\Importer\ImportHandler;
use App\Services\Uploader\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Importer;
use Ramsey\Uuid\Uuid;
use Tests\ImportTestBuilder;
use Tests\TestCase;

class FileImportJobTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
        Queue::fake();
        Storage::fake('docs');
    }

    public function testSuccess(): void
    {
        $data = [[
            [1, 'name 1', '01.02.03'],
            [2, 'name 2', '01.02.03'],
            [3, 'name 3', '01.02.03'],
        ]];

        $mock = $this->createMock(Excel::class);
        $this->partialMock(Importer::class, fn() => $mock->method('toArray')
            ->willReturn($data));

        (new FileImportJob(new File(Uuid::uuid4() . '.xls')))->handle($mock);

        $this->assertDatabaseCount('rows', 3);
    }
}
