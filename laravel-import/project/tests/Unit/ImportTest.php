<?php

namespace Tests\Unit;


use App\Services\Importer\Import;
use PHPUnit\Framework\TestCase;
use Tests\ImportTestBuilder;

class ImportTest extends TestCase
{
    private Import $builder;

    protected function setUp(): void
    {
        parent::setUp();
        $data = [
            ['name' => 'name 1', 'date' => '01.02.03'],
            ['name' => 'name 2', 'date' => '01.02.03'],
            ['name' => 'name 2', 'date' => '01.02.03'],
            ['name' => 'name 2', 'date' => '01.02.03'],
        ];

        $this->builder = (new ImportTestBuilder())
            ->setData($data)
            ->setImportLimit(2)
            ->build();
    }

    public function testAddTotalImportedRows(): void
    {
        $this->builder->addImportedTotalRows(5);
        $this->builder->addImportedTotalRows(5);

        $this->assertEquals(10, $this->builder->getImportedTotalRows());
    }

    public function testIsCompleted(): void
    {
        $this->assertFalse($this->builder->isCompleted());
        $this->builder->addImportedTotalRows(10);

        $this->assertTrue($this->builder->isCompleted());
    }
}
