<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyMconsoleOptionsTableAddGroupColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mconsole_options', function (Blueprint $table) {
            $table->string('group')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mconsole_options', function (Blueprint $table) {
            $table->dropColumn('group');
        });
    }
}
