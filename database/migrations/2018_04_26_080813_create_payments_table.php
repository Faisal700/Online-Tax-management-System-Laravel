<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citizen_id')->nullable();
            $table->integer('account_number')->nullable();
            $table->integer('amount')->nullable();
            $table->enum('type', ['Credit','Printout']);
            $table->string('payment_slip')->nullable();
            $table->string('date')->nullable();
            $table->enum('status',['Pending','Completed', 'Rejected']);
            $table->integer('seen')->default(0)->comment('0 for not seen,1 for admin seen,2 for citizen seen');
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
        Schema::dropIfExists('payments');
    }
}
