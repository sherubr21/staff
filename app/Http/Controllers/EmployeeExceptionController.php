<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tblstaffattendance;
use DB;

class EmployeeExceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();
      
        
        return view('ListStaff1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo $request->get('sup');
        $updateSupervisorCmd=Tblstaffattendance::find($request->get('id'));
        $updateSupervisorCmd->SupervisorComment=$request->get('supervisorcomment');
        $updateSupervisorCmd->save();
        return redirect()->back()->with('success','Successful Updated !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //echo $id;
      $findException=Tblstaffattendance::where('Staff',$id)
                      
					  ->orderBy('CreatedOn','Desc')
                       ->get();
       session_start();
      
              
    
       return view('EmployeeException',['findException' => $findException],['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        echo $request->get('id');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
