<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreProfilesEditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_profiles', function (Blueprint $table) {
            $table->decimal('change', 12, 2)->nullable()->after('gmaps');
            $table->timestamp('created_change')->nullable()->after('change');
            $table->string('plan')->nullable()->after('created_change');
            $table->date('date_expiration')->nullable()->after('plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_profiles', function (Blueprint $table) {
            $table->dropColumn('change');
            $table->dropColumn('created_change');
            $table->dropColumn('plan');
            $table->dropColumn('date_expiration');
        });
    }
}
