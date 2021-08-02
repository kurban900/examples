<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowsTable extends Migration
{

    public function up(): void
    {
        Schema::create('rows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rows');
    }
}
