<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBaseIdAndAccessKeyToSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->text('base_id')->nullable()->after('type');
            $table->text('access_key')->nullable()->after('base_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('access_key');
            $table->dropColumn('base_id');
        });
    }
}
