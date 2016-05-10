<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyImagesTableAddDescriptionAndLangColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->text('description')->nullable()->after('preset_id');
            $table->string('title')->nullable()->after('preset_id');
            $table->integer('language_id')->default(0)->after('preset_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('title');
            $table->dropColumn('language_id');
        });
    }
}
