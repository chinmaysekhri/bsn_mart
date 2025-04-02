<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;
  
class SocialShareController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $shareButtons = \Share::page(
            'https://www.bsnmart.com',
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
  
        $posts = Product::get();
  
        return view('socialshare', compact('shareButtons', 'posts'));
    }
}