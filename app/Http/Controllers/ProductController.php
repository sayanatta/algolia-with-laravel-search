<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'brand' => 'required',
                'price' => 'required|numeric',
                'categories' => 'required',
                'description' => 'required',
            ]);

            $product = new Product();
            $product->name = $request->name;
            $product->brand = $request->brand;
            $product->price = $request->price;
            $product->categories = json_encode($request->categories);
            $product->description = $request->description;
            $product->save();

            return redirect()->back()->with('success', 'Product created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function backend_search(Request $request)
    {
        $query = null;
        $search = null;
        $min_price = null;
        $max_price = null;
        if (isset($request->query()['query'])) {
            $query = $request->query()['query'];
            $search = str_replace('-', ' ', $query);
        }
        $products = Product::search($query);
        if (isset($request->query()['min_price']) && !empty($request->query()['min_price']) && isset($request->query()['max_price']) && !empty($request->query()['max_price'])) {
            $products = $products->whereBetween('price', [$request->query()['min_price'], $request->query()['max_price']]);
            $min_price = $request->query()['min_price'];
            $max_price = $request->query()['max_price'];
        }

        if (isset($request->query()['filter']) && !empty($request->query()['filter'])) {
            if ($request->query()['filter'] == 'a_to_z') {
                $products = $products->orderBy('name', 'ASC');
                // $products = $products->setSettings(['customRanking' => ['asc(name)']]);
            }
            if ($request->query()['filter'] == 'z_to_a') {
                // $products = $products->orderBy('name', 'DESC');
            }
            if ($request->query()['filter'] == 'low_to_high') {
                $products = $products->orderBy('price', 'ASC');
            }
            if ($request->query()['filter'] == 'high_to_low') {
                $products = $products->orderBy('price', 'DESC');
            }
        }
        $products = $products->get();
        return view('product.backend-search', compact('products', 'search', 'min_price', 'max_price'));
    }

    public function search(Request $request)
    {
        $query = Str::slug($request->search);
        $filter = $request->filter;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $route = route('backend_search') . '?query=' . $query . '&filter=' . $filter . '&min_price=' . $min_price . '&max_price=' . $max_price;
        return redirect($route);
    }
}
