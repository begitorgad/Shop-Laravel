<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

        public function home()
    {
        $data = [
        "title"=> "Welcome to our shop",
        "nbProducts"=> "150",
        "status"=> "Open"

        ];   

        return view('home', $data);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return 'Contact us';
    }

    public function register(){
        return view('auth.register');
    }

}
