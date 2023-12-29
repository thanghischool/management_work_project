<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Schema::table('projects', function (Blueprint $table) {
        //     $table->string('background_image')->after('background_color');
        // });

        // // Copy dữ liệu từ cột cũ sang cột mới
        // DB::statement('UPDATE projects SET background_image = background_color');

        // // Xóa cột cũ
        // Schema::table('projects', function (Blueprint $table) {
        //     $table->dropColumn('background_color');
        // });
    }

    public function down()
    {
        // // Thêm lại cột cũ
        // Schema::table('projects', function (Blueprint $table) {
        //     $table->string('background_color')->after('some_column');
        // });

        // // Copy dữ liệu từ cột mới sang cột cũ
        // DB::statement('UPDATE projects SET background_color = background_image');

        // // Xóa cột mới
        // Schema::table('projects', function (Blueprint $table) {
        //     $table->dropColumn('background_image');
        // });
    }
};
