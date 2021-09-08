<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbllocation extends Model
{
    const CREATED_AT = 'CreatedAt';
    
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'UpdatedAt';
   // const ID = 'StaffAttendanceNum';
   protected $primaryKey = 'LocationNum';
}
