<?php

namespace Tests\Feature;

use App\Events\ImportCompleted;
use App\Events\ImportPartCompleted;
use App\Jobs\FileImportJob;
use App\Services\Importer\ImportHandler;
use App\Services\Uploader\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Tests\ImportTestBuilder;
use Tests\TestCase;

class ImportHandlerTest extends TestCase
{
    use RefreshDatabase;

    private ImportHandler $handler;
    private ImportTestBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
        Queue::fake();
        Storage::fake('docs');

        $this->handler = new ImportHandler();
        $this->builder = new ImportTestBuilder();
    }

    public function testImportCompleted(): void
    {
        $data = [
            [1, 'name 1', '01.02.03'],
            [2, 'name 2', '01.02.03'],
        ];
        $import = $this->builder
            ->setData($data)
            ->setImportLimit(2)
            ->build();

        $this->handler->handle($import);

        $this->assertDatabaseCount('rows', 2);
        Event::assertDispatched(ImportCompleted::class);
    }

    public function testImportPartCompleted(): void
    {
        $data = [
            [1, 'name 1', '01.02.03'],
            [2, 'name 2', '01.02.03'],
            [3, 'name 3', '01.02.03'],
        ];
        $import = $this->builder
            ->setData($data)
            ->setImportLimit(2)
            ->build();

        $this->handler->handle($import);

        Event::assertDispatched(ImportPartCompleted::class);
    }

    public function testFileImportJob(): void
    {
        $data = [[
            [1, 'name 1', '01.02.03'],
            [2, 'name 2', '01.02.03'],
            [3, 'name 3', '01.02.03'],
        ]];
        $mock = $this->createMock(Excel::class);
        $this->partialMock(Excel::class, fn() => $mock->method('toArray')->willReturn($data));

        (new FileImportJob(new File('test.xls')))->handle($mock);

        $this->assertDatabaseCount('rows', 3);
    }
}

