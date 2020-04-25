<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateApplicationFieldsV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function ($table) {
            $table->string('teller_number');
            $table->string('email');
            $table->string('father_email');
            $table->renameColumn('father_postal_code', 'father_postal_address');
            $table->renameColumn('father_mobile_phone', 'father_contact_number_1');
            $table->renameColumn('father_home_phone', 'father_contact_number_2');
            $table->string('mother_email');
            $table->renameColumn('mother_postal_code', 'mother_postal_address');
            $table->renameColumn('mother_mobile_phone', 'mother_contact_number_1');
            $table->renameColumn('mother_home_phone', 'mother_contact_number_2');
            $table->string('sponsor_email');
            $table->renameColumn('sponsor_postal_code', 'sponsor_postal_address');
            $table->renameColumn('sponsor_mobile_phone', 'sponsor_contact_number_1');
            $table->renameColumn('sponsor_home_phone', 'sponsor_contact_number_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
