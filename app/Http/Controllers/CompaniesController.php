<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{

    function viewCompany(){
        $Companies = Companies::paginate(10);
        return view('Company' ,compact('Companies'));
    }

    function store(Request $request){


        if($request->email){

            $request -> validate([
                'name' => 'required',
                'email' => 'email',
            ]);
        }

        else{
            $request -> validate([
                'name' => 'required',
            ]);
        }


        if(!($request->id)){

            $Companies = new Companies();
            $Companies -> Name = $request -> name ;
            $Companies -> email = $request -> email ;
            $Companies -> website = $request -> website ;

            if($request->hasFile('image')){

                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png',
                ]);

                $image = $request->file('image');
                $image_name =  time() . '.' . $image->extension();
                $image->storeAs('public/', $image_name);
                $Companies -> logo = $image_name;
            }

            $Companies -> save();
            return redirect('/companies')->with('success','Record Successfully');
        }

        else{
            $Companies = Companies::find($request->id);
            $Companies -> Name = $request -> name ;
            $Companies -> email = $request -> email ;
            $Companies -> logo = $request -> logo ;
            $Companies -> website = $request -> website ;
            $Companies -> save();
            return redirect('/companies')->with('success','Updated Successfully');
        }

    }

    function delete($id){
        $Companies = Companies::find($id);
        $Companies -> delete();
        return redirect('/companies')->with('success','Deleted Successfully');
    }
}
