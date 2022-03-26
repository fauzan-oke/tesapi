<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }



    public function index()
   {
       return response()->json(Auth::user()->product);
   }

   public function create(Request $request)
   {
       $validated = $this->validate($request, [
           'product_name' => 'required|max:255',
           'stok' => 'required|min:1',
           'price' => 'required|min:1',
           'category_id' => 'required'
       ]);

       $product = new Product();
       $product->product_name = $validated['product_name'];
       $product->stok = $validated['stok'];
       $product->price = $validated['price'];
       $product->category_id = $validated['category_id'];
       $product->user_id = Auth::user()->id;
       $product->save();
       return response()->json(['error' => 'false', 'success' => 'true'],201);
//       return response()->json($product);
   }

   public function show(Request $request, $id)
  {
      $product = Product::where('id', $id)->where('user_id', Auth::user()->id)->first();
      if (empty($product)) {
          abort(404, "Dat not found");
      }
      return response()->json(['error'=>'false','data'=>$product]);
  }


  public function update(Request $request, $id)
    {
        $product = product::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (empty($product)) {
            abort(404, "Dat not found");
        }
        $validated = $this->validate($request, [
            'product_name' => 'required|max:255',
            'stok' => 'required|min:1',
            'price' => 'required|min:1',
            'category_id' => 'required'
        ]);
        $product->product_name = $validated['product_name'];
        $product->stok = $validated['stok'];
        $product->price = $validated['price'];
        $product->category_id = $validated['category_id'];
        $product->save();
        return response()->json(['error' => 'false', 'success' => 'true'],201);
    }

    public function delete(Request $request, $id)
    {
        $product = Product::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (empty($product)) {
            abort(404, "Dat not found");
        }
        $product->delete();
        return response()->json(['error' => 'false', 'success' => 'true'],201);
    }
    //
}
