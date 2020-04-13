<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',  // Status
        'application_ref', 'entry_class', 'enrollment_centre', 'enrollment_type',  // Enrollment Details
        'first_name', 'last_name', 'other_names', 'gender', 'date_of_birth', 'place_of_birth', 'previous_school', 'reason_for_leaving', 'individual_peculiarity', 'image_name', // Applicant's Details
        'father_first_name', 'father_last_name', 'father_other_names', 'father_contact_address', 'father_postal_code', 'father_mobile_phone', 'father_home_phone', // Father Details
        'mother_first_name', 'mother_last_name', 'mother_other_names', 'mother_contact_address', 'mother_postal_code', 'mother_mobile_phone', 'mother_home_phone', // Mother Details
        'sponsor_first_name', 'sponsor_last_name', 'sponsor_other_names', 'sponsor_contact_address', 'sponsor_relationship', 'sponsor_postal_code', 'sponsor_mobile_phone', 'sponsor_home_phone', // Sponsor Details
    ];


}
