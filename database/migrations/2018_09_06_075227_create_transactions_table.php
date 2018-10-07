<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_trans_id');
            $table->string('patient_id');
            $table->string('incharge_doc');
            $table->string('wardName');
            $table->string('bedNo');
            $table->dateTime('date_discharge')->nullable();
            $table->dateTime('date_incharge');
            $table->string('findings')->nullable();
            $table->string('prescription')->nullable();
            $table->string('totalBills')->nullable();
            $table->string('patientStatus')->default('Active');
            $table->string('tenderAmount')->nullable();
            $table->string('change')->nullable();
            $table->string('amountDisc')->nullable();
            $table->string('totalDiscounted')->nullable();
            $table->string('typeOfDiscount')->nullable();
            $table->string('DiscounteId')->nullable();
            $table->string('SponsorOfDiscount')->nullable();
            $table->string('admitDiagnos');
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
        Schema::dropIfExists('Transactions');
    }
}
