<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('uploader_name')->nullable()->after('cover_image'); // Thêm cột uploader_name
        });
    }
    
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('uploader_name');
        });
    }
    
};
