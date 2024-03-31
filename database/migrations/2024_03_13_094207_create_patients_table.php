<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('othernames')->nullable();
            $table->string('lastname')->nullable();
            $table->date('dob')-> nullable();
            $table->string('marital_status')-> nullable();
            $table->string('gender')-> nullable();
            $table->string('phone_number')-> nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('genotype')->nullable();
            $table->string('allergies')->nullable();
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
