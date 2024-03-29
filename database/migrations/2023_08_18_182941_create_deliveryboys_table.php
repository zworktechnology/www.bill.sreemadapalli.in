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
        Schema::create('deliveryboys', function (Blueprint $table) {

            // Auto-generate ID column
            $table->id();

            // Request columns
            $table->string('user_key');
            $table->string('unique_key')->unique();
            $table->boolean('soft_delete')->default(0);
            $table->string('name');
            $table->string('phone_number');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('delivery_area_id')->nullable();
            $table->foreign('delivery_area_id')->references('id')->on('deliveryareas');
            $table->string('perdaysalary')->nullable();

            // CreatedAt & UpdatedAt columns
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
        Schema::dropIfExists('deliveryboys');
    }
};
