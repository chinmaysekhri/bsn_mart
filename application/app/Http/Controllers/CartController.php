<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lead;
use App\Models\Company;
use App\Models\Product;
use App\Models\Cart;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Mail;
use App\Mail\RegisterMail;

    
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	function __construct()
    {
        // $this->middleware('permission:cart-list|cart-create|cart-edit|company-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:cart-create', ['only' => ['create','store']]);
        // $this->middleware('permission:cart-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:cart-delete', ['only' => ['destroy']]);
    }
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
/*     public function index(Request $request): View
     {
	
		    return view('carts.index');
			
     } */
    
    public function cart(Request $request): View
     {
	
	   return view('carts.cart');
			
     }
	 
	 
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
     {
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    
    
   
	
	
	
}