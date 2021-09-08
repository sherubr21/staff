<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tblstaffattendance extends Model
{
    const CREATED_AT = 'CreatedOn';
    
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'UpdatedOn';
   // const ID = 'StaffAttendanceNum';
   protected $primaryKey = 'StaffAttendanceNum';
   protected $table = 'tblStaffAttendance';
}
