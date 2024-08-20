<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('file_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("file_data_id")->nullable()->constrained("file_data");
            $table->string("file_name")->nullable();
            $table->string("file_extension")->nullable();
            $table->string("file_size")->nullable();
            $table->string("user_id")->nullable();
            $table->morphs("model");
            $table->string("group")->default("default")->nullable();
            $table->string('disk')->default('local')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('path')->nullable();
            $table->uuid('uuid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_items');
    }
};
