<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class ProductsController extends RankingController
{
        public function __construct()
        {
            parent::__construct();
            $this->middleware('auth',array('only' => 'search'));
        }
        // productsテーブルから最新順に作品を20件取得する
            public function index()
    {

        $products = Product::orderBy('id','ASC')->take(20)->get();
        return view('products.index')->with('products', $products);
    }

    public function show($id)
    {
       $product = Product::find($id);
        $products = array();
        return view('products.show')->with('product', $product);
    }

    public function search(Request $request)
    {
        // 検索フォームのキーワードをあいまい検索して、productsテーブルから20件の作品情報を取得する
$request = Product::where('title','LIKE',"{$request->keyword}%")->take(20)->get();
 $products = array();
       
        return view('products.search')->with('products', $products);
    }
}
