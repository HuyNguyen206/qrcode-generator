<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->float('balance', 10, 4)->default(0);
            $table->float('total_credit', 10, 4)->default(0);
            $table->float('total_debit', 10, 4)->default(0);
            $table->string('withdrawal_method')->default('bank'); //paypal, bank, stripe
            $table->string('payment_email')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account')->nullable();
            $table->boolean('applied_for_payout')->default(0);
            $table->boolean('paid')->default(0);
            $table->string('country')->nullable();
            $table->date('last_date_applied')->nullable();
            $table->date('last_date_paid')->nullable();
            $table->text('other_details')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('accounts');
    }
}
