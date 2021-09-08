<?php
namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyAttendanceExport implements FromView
{
    protected $dateRange;
    protected $staffs;
    protected $staffAttendance;
    public function __construct($staffAttendance,$staffs,$dateRange){
        $this->dateRange = $dateRange;
        $this->staffs = $staffs;
        $this->staffAttendance = $staffAttendance;
    }
    public function view(): View
    {
        return view('partials.montehlyAtttendanceview Table_partial', [
            'dateRange' => $this->dateRange,
            'staffs' => $this->staffs,
            'staffAttendance' => $this->staffAttendance,
        ]);
    }
}