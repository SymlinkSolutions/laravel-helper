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
        Schema::table('file_items', function (Blueprint $table) {
            $table->foreignId('file_item_id')->nullable()->references('id')->on('file_items');
            $table->string("file_item_type")->nullable();
            $table->foreignId("file_data_id")->nullable()->constrained("file_data");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_items', function (Blueprint $table) {
            $table->dropForeign(['file_data_id']);
            $table->dropForeign(['file_item_id']);
            $table->dropColumn('file_item_id');
            $table->dropColumn('file_item_type');
        });
    }
};
