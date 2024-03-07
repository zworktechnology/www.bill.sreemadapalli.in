<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closeaccounts', function (Blueprint $table) {
            $table->id();
            $table->string('unique_key')->unique();
            $table->boolean('soft_delete')->default(0);

            $table->string('date')->nullable();
            $table->string('sales')->nullable();
            $table->string('cash')->nullable();
            $table->string('card')->nullable();
            $table->string('paytm_business')->nullable();
            $table->string('paytm')->nullable();
            $table->string('phonepe_business')->nullable();
            $table->string('phonepe')->nullable();
            $table->string('gpay_business')->nullable();
            $table->string('gpay')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closeaccounts');
    }
};
