<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_orders', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('order_number')->nullable();
            $table->date('approval_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->foreignId('contract_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('contract_orders');
    }
}
