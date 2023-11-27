<?php


namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //added code
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'price'=>'required'
        ]);
        return Product::create($request->all());
        //added code
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //added code
        return Product::find($id);
        //added code
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //added code
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
        //added code
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //added code
        return Product::destroy($id);

        //added code
    }


    /**
     * Search for a  specified resource from storage.
     */
    public function search($name)
    {
        //added code
        return Product::where('name','like','%'.$name.'%')->get();
        //products that start with are like that name
        //added code
    }
}
