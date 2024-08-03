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
            $table->foreignId("file_data_id")->constrained("file_data")->nullable();
            $table->string("file_name")->nullable();
            $table->string("file_extension")->nullable();
            $table->string("file_size")->nullable();
            $table->string("user_id")->nullable();
            $table->morphs("model");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_items', function (Blueprint $table) {
            $table->dropForeign(['file_data_id']);
            $table->dropColumn('file_data_id');
        });
        Schema::dropIfExists('file_items');
    }
};
