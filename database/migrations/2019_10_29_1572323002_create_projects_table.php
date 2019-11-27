<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('quotation_id')->index();
            $table->string('code', 20)->unique();
            $table->string('title', 100);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status', 25)->index()->default('new');
            $table->decimal('amount', 13, 2);
            $table->boolean('with_ppn')->default(true);
            $table->text('terms')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
