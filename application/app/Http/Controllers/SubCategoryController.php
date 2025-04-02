<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategories;
use App\Models\Categories;
use App\Models\Seller;
use Auth;
use DB;
use Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Mail;
use App\Mail\RegisterMail;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
       
     /*  $data = SubCategories::select('subcategories.*','categories.category_name as CategoryName')
                           ->leftjoin('categories', 'categories.id', 'subcategories.category_id')
                           ->orderBy('subcategories.id','DESC')->paginate(25);
                            return view('subcategories.index',compact('data'));*/
        
       	//Date 01-02-2025 Start 
		
		    $per_page = 25;
    
            $data = SubCategories::select('subcategories.*','categories.category_name as CategoryName')
                                 ->leftjoin('categories', 'categories.id', 'subcategories.category_id')
			                     ->when($request->q,function (Builder $builder) use ($request) {
                                   $builder->where('sub_category_name', 'like', "%{$request->q}%");
                                
                                    }
                                  )
							  ->orderBy('subcategories.id','DESC')
							  ->paginate($per_page);
              
               return view('subcategories.index',compact('data'))
               ->with('i', ($request->input('page', 1) - 1) * $per_page);					
		
		//Date 01-02-2025 End 
        
        
                            
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
			$auth_user  = Auth::user();
		
			if(!empty($auth_user->seller_id)){
				
			$sellerData = Seller::find($auth_user->seller_id);
			
			$sellerCategoryIDS  = json_decode($sellerData->category_id,true);

			$categoryData        = Categories::whereIn('id',$sellerCategoryIDS)->get();
				
			}else{
				
				$categoryData  = Categories::get();
			}
			
            return view('subcategories.create',compact('categoryData'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             $input               = $request->all(); 
			 $auth_user           = Auth::user();
             $input['created_by'] = $auth_user->id;
			 
			// $cate_data = Categories::where('category_name','=',$input['category_name'])->first();
			//date-22-05-2024
			 $cate_data = Categories::where('id','=',$input['category_id'])->first();
			 
			 if(empty($cate_data)){
				 
				 return back()->withErrors(['Category Name Not Exist Please Select Correct category Name'])->withInput();
				 
			 }
			 
			 $input['category_id'] = $cate_data->id;
			 
			 unset($input['category_name']);
			 
             $subcategory = SubCategories::create($input);
			 
             return redirect()->route('subcategories.index')->with('success','SubCategory created successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $subcategory = SubCategories::find($id);
		 
         $cate        = SubCategories::select('subcategories.*', 'categories.category_name')
                            ->leftjoin('categories', 'categories.id', 'subcategories.category_id')
                            ->where('subcategories.id','=',$subcategory->id)->first();
							
         return view('subcategories.show',compact('subcategory','cate'));
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory  = SubCategories::find($id);
       // $categoryData = Categories::orderBy('category_name', 'DESC')->get();
	
		$auth_user  = Auth::user();
		
			if(!empty($auth_user->seller_id)){
				
			$sellerData = Seller::find($auth_user->seller_id);
			
			$sellerCategoryIDS  = json_decode($sellerData->category_id,true);

			$categoryData       = Categories::whereIn('id',$sellerCategoryIDS)->get();
				
			}else{
				
			$categoryData  = Categories::get();
			}
		
		    $cate    =  SubCategories::select('subcategories.*', 'categories.category_name')
                            ->leftjoin('categories', 'categories.id', 'subcategories.category_id')
                            ->where('subcategories.id','=',$subcategory->id)->first();
		
	   
		
			
		
        return view('subcategories.edit', compact('subcategory','categoryData','cate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
      $input    = $request->all();
        
	  $auth_user           = Auth::user();
      $input['created_by'] = $auth_user->id;
	  
	  $category = SubCategories::find($id);
	  
	       //$cate_data = Categories::where('category_name','=',$input['category_name'])->first();
	      //date-22-05-2024
	      
	        $cate_data = Categories::where('id','=',$input['category_id'])->first();
	        
			 if(empty($cate_data)){
				 
				 return back()->withErrors(['Category Name Not Exist Please Select Correct category Name'])->withInput();
				 
			 }
			 $input['category_id'] = $cate_data->id;
			 
			 unset($input['category_name']);
	  
      $category->update($input);
      return redirect()->route('subcategories.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SubCategories::find($id)->delete();
        return redirect()->route('subcategories.index')->with('success','Category deleted successfully');
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category_autocomplete(Request $request)
    {
		$search_val = $request->get('query').'%';
		
        $data = Categories::select("category_name as name")
                    ->where('category_name', 'LIKE', $search_val)
                    ->get();
     
        return response()->json($data);
    }

}
