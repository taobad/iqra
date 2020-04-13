<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('application_ref');
            $table->string('status');
            $table->string('entry_class')->nullable();
            $table->string('enrollment_centre')->nullable();
            $table->string('enrollment_type')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('other_names')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('previous_school');
            $table->string('reason_for_leaving');
            $table->text('individual_peculiarity')->nullable();
            $table->string('image_name');
            $table->string('father_first_name');
            $table->string('father_last_name');
            $table->string('father_other_names');
            $table->string('father_contact_address');
            $table->string('father_postal_code');
            $table->string('father_mobile_phone');
            $table->string('father_home_phone');
            $table->string('mother_first_name');
            $table->string('mother_last_name');
            $table->string('mother_other_names');
            $table->string('mother_contact_address');
            $table->string('mother_postal_code');
            $table->string('mother_mobile_phone');
            $table->string('mother_home_phone');
            $table->string('sponsor_first_name');
            $table->string('sponsor_last_name');
            $table->string('sponsor_other_names');
            $table->string('sponsor_contact_address');
            $table->string('sponsor_postal_code');
            $table->string('sponsor_mobile_phone');
            $table->string('sponsor_home_phone');
            $table->string('sponsor_relationship');
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
        Schema::drop('applications');
    }
}
