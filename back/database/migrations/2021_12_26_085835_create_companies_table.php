<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('user_detail_id')->constrained()->onDelete('CASCADE');
            $table->string('current_position');
            $table->string('company_name');
            $table->string('company_phone');
            $table->string('company_email');
            $table->string('company_address');
            $table->string('company_website');
            $table->string('hr_name');
            $table->string('hr_email');
            $table->string('hr_phone');
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
