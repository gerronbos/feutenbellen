<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->integer("pledge_id");
            $table->text("description")->nullable();
            $table->string("result")->nullable();
            $table->string("year");
            $table->boolean("status")->default(0);
            $table->timestamps();
        });

        Schema::create('pledges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->nullable();
            $table->string("initials")->nullable();
            $table->string("firstname");
            $table->string("middlename")->nullable();
            $table->string("lastname");
            $table->date("dateofbirth");
            $table->string("sex");
            $table->string("living_place")->nullable();
            $table->string("living_street")->nullable();
            $table->string("living_nr")->nullable();
            $table->string("living_extra")->nullable();
            $table->string("living_postcode")->nullable();
            $table->string("home_phone")->nullable();
            $table->string("mobile")->nullable();
            $table->string("phone_extra")->nullable();
            $table->string("emergency_phone")->nullable();
            $table->string("email")->nullable();
            $table->string("education")->nullable();
            $table->string("education_type")->nullable();
            $table->string("shirt_size")->nullable();
            $table->boolean("rabo_bicycle")->default("0");
            $table->text("diet")->nullable();
            $table->boolean("vegetarian")->default("0");
            $table->boolean("pay_forward")->default("0");
            $table->text("description")->nullable();
            $table->boolean("call_state")->default("0");
            $table->integer("status")->default("0");
            $table->string("year");
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
        Schema::dropIfExists('calls');
        Schema::dropIfExists('pledges');
    }
}
