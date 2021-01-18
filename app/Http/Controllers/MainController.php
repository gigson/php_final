<?php

namespace App\Http\Controllers;

use App\comment;
use App\like;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products = product::with(["categories"])->get();
        return view('welcome', [
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {
        $comment = comment::create([
            "text" => $request->input("comment"),
            "user_id" => Auth::id(),
            "product_id" => $request->input("product_id"),
        ]);

        return MainController::show($request->input("product_id"));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($productId)
    {
        $product = product::with(["categories", "comments", "comments.user"])->where(["id" => $productId])->first();
        $likes = like::where(["product_id" => $productId])->get();
        $liked = false;
        foreach ($likes as $like) {
            if ($like->user_id == Auth::id()) {
                $liked = true;
            }
        }

        return view('single', [
            "product" => $product,
            "like_count" => count($likes),
            "liked" => $liked
        ]);
    }

    public function likeProduct(Request $request)
    {
        $likes = like::where(["product_id" => $request->input("product_id")])->get();
        foreach ($likes as $like) {
            if ($like->user_id == Auth::id()) {
                return MainController::show($request->input("product_id"));
            }
        }

        like::create([
            "user_id" => Auth::id(),
            "product_id" => $request->input("product_id"),
        ]);

        return MainController::show($request->input("product_id"));
    }

    public function unlikeProduct(Request $request)
    {
        like::where([
            "user_id" => Auth::id(),
            "product_id" => $request->input("product_id"),
        ])->delete();

        return MainController::show($request->input("product_id"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
