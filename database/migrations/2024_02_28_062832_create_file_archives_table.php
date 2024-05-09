<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_archives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_name');
            $table->string('file_ext');
            $table->text('tags')->nullable()->default('default');
            $table->foreignId('type_id');
            $table->foreignId('type_secondary_id')->nullable();
            $table->foreignId('type_tertiary_id')->nullable();
            $table->foreignId('type_tertiary_sub_id')->nullable();
            $table->foreignId('user_id');
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
        Schema::dropIfExists('file_archives');
    }
}
