<?php

namespace App\Http\Controllers;

use App\category;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
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
        if (Auth::id() != 1){
            abort(403, 'Access denied');
        }

        return view('home');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProduct(Request $request)
    {
        if (Auth::id() != 1){
            abort(403, 'Access denied');
        }

        $this->validate($request, [
            "image" => "required",
        ]);

        if (Input::file("image")) {
            $dest = public_path("images");
            $filename = uniqid() . ".jpg";
            Input::file("image")->move($dest, $filename);
        }

        $product = product::create([
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "price" => $request->input("price"),
            "image" => $filename,
        ]);

        foreach ($request->input("categories") as $category) {
            if ($category == null) {
                continue;
            }
            category::create([
                "product_id" => $product->id,
                "name" => $category
            ]);
        }

        return redirect()->route('admin');

    }

}
