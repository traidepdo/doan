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
            $table->string('uploaded_by')->after('id'); // Lưu tên admin
        });
    }
    
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('uploaded_by');
        });
    }
    
};
