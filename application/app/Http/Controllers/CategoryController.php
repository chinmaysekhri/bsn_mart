<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categories;
use Auth;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Mail;
use App\Mail\RegisterMail;
class CategoryController extends Controller
{
/**
* Display a listing of the resource.
*/
public function index(Request $request): View
{
    // $per_page = 10;
     // $data = Categories::orderBy('id','DESC')->paginate($per_page);
     // return view('categories.index',compact('data'));
      $per_page = 10;
    
    $data = Categories::when($request->q,function (Builder $builder) use ($request) {
                  $builder->where('category_name', 'like', "%{$request->q}%");
                    //->orWhere('email', 'like', "%{$request->q}%");
                }
              )
              ->orderBy('id','DESC')
              ->paginate($per_page);
              
            return view('categories.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);
}

/**
* Show the form for creating a new resource.
*/
public function create()
{
     return view('categories.create');
}

/**
* Store a newly created resource in storage.
*/
public function store(Request $request)
{
     //dd($request->all());
       $input = $request->all();
       $category = Categories::create($input);
       return redirect()->route('categories.index')->with('success','Category created successfully');
}

/**
* Display the specified resource.
*/
public function show(string $id)
{
      $category = Categories::find($id);
      return view('categories.show',compact('category'));
}

/**
* Show the form for editing the specified resource.
*/
public function edit(string $id)
{
     $category=Categories::find($id);
    //dd($category);
     return view('categories.edit',compact('category'));
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request, $id): RedirectResponse
{
    $input = $request->all();
    //dd($input);
    $category = Categories::find($id);
    $category->update($input);
    return redirect()->route('categories.index')->with('success','Category updated successfully');
}

/**
* Remove the specified resource from storage.
*/
public function destroy($id): RedirectResponse
{
    Categories::find($id)->delete();
    return redirect()->route('categories.index')->with('success','Category deleted successfully');
}
}