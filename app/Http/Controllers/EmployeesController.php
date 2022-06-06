<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Companies;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    function viewEmployee(){
        $Companies = Companies::all();
        $Employees = Employees::join('companies','companies.id','=','employees.Company')
        ->select('employees.*','companies.Name')
        ->paginate(10);
        return view('employee' ,compact('Employees','Companies'));
    }

    function store(Request $request){

        if($request->email){

            $request -> validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'email',
            ]);
        }

        else{
            $request -> validate([
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
        }


        if(!($request->id)){
            $Employees = new Employees();
            $Employees -> firstName = $request -> first_name ;
            $Employees -> lastName = $request -> last_name ;
            $Employees -> Company  = $request -> company ;
            $Employees -> email = $request -> email ;
            $Employees -> phone = $request -> phone ;
            $Employees -> save();
            return redirect('/employees')->with('success','Record Successfully');
        }

        else{

            $Employees =  Employees::find($request->id);
            $Employees -> firstName = $request -> first_name ;
            $Employees -> lastName = $request -> last_name ;
            $Employees -> Company  = $request -> company ;
            $Employees -> email = $request -> email ;
            $Employees -> phone = $request -> phone ;
            $Employees -> save();
            return redirect('/employees')->with('success','Record Successfully');

        }

    }

    function delete($id){
        $Employees = Employees::find($id);
        $Employees -> delete();
        return redirect('/employees')->with('success','Deleted Successfully');
    }
}
