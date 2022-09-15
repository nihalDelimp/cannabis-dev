<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $table->bigInteger('phone')->nullable()->after('email');
            $table->text('organization')->nullable()->after('phone');
            $table->timestamp('dob')->nullable()->after('organization');
            $table->string('position')->nullable()->after('dob');
            $table->string('instagram_name')->nullable()->after('position');
            $table->Integer('insterested_status')->nullable()->after('instagram_name')->comment('1=>yes, 0=>no');
            $table->string('invited_owner')->nullable()->after('insterested_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('phone');
            $table->dropColumn('organization');
            $table->dropColumn('dob');
            $table->dropColumn('position');
            $table->dropColumn('instagram_name');
            $table->dropColumn('insterested_status');
            $table->dropColumn('invited_owner');
        });
    }
}
