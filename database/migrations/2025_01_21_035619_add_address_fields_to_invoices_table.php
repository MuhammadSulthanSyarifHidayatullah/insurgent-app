<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('name')->after('status');
            $table->string('address')->after('name');
            $table->string('city')->after('address');
            $table->string('state')->after('city');
            $table->string('postal_code')->after('state');
            $table->string('country')->after('postal_code');
            $table->string('payment_method')->after('country');
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['name', 'address', 'city', 'state', 'postal_code', 'country', 'payment_method']);
        });
    }
};

