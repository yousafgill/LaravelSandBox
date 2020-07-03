<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\employee;
class EmployeeController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees=employee::get();
        return view('employees.index',compact('employees'));
    }


    public function create(){
        return view('employees.create');
    }

    public function createsave(Request $r){
        $emp=new employee();
        $emp->firstname=$r->firstname;
        $emp->lastname=$r->lastname;
        $emp->email=$r->email;
        $emp->phone=$r->phone;
        $emp->departmentid=1;
        $emp->designationid=1;
        $emp->save();

        return redirect('/employees/index');
    }
}
