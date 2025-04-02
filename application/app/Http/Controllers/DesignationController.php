<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Mail;
use App\Mail\RegisterMail;
use Auth;
use DB;
use Hash;

class DesignationController extends Controller
{

public function index(Request $request): View
{
     
	// $per_page = 10;
   
  //    $data = Designation::orderBy('id','DESC')->paginate($per_page);
   
  //    return view('designations.index',compact('data'));

   $per_page = 10;
    
    $data = Designation::when($request->q,function (Builder $builder) use ($request) {
                  $builder->where('designation_name', 'like', "%{$request->q}%");
                    //->orWhere('email', 'like', "%{$request->q}%");
                }
              )
              ->orderBy('id','DESC')
              ->paginate($per_page);
              
            return view('designations.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);
    
}

/**
* Show the form for creating a new resource.
*/
public function create(){
	
     return view('designations.create');
}

/**
* Store a newly created resource in storage.
*/
public function store(Request $request){
    
       $input = $request->all();
	   
       $designation = Designation::create($input);
	   
       return redirect()->route('designations.index')->with('success','Designation Created Successfully!!');
}

/**
* Display the specified resource.
*/
public function show(string $id){
	
      $designation = Designation::find($id);
	  
      return view('designations.show',compact('designation'));
}

/**
* Show the form for editing the specified resource.
*/
public function edit(string $id){
	
     $designation=Designation::find($id);
   
     return view('designations.edit',compact('designation'));
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request, $id): RedirectResponse{
	
    $input = $request->all();
   
    $designation = Designation::find($id);
	
    $designation->update($input);
	
    return redirect()->route('designations.index')->with('success','Designation Updated Successfully!!');
}

/**
* Remove the specified resource from storage.
*/
public function destroy($id): RedirectResponse
{
    Designation::find($id)->delete();
	
    return redirect()->route('designations.index')->with('success','Designation Deleted Successfully!!');
    }
}
