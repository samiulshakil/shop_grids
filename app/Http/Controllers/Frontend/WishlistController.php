<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.wishlist.wishlist', compact('wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToWishlist(Request $request){
        $product_id = $request->product_id;
        if (Auth::check()) {
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if (!$exists) {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                ]);

                $wishcount = wishlists();
                return response()->json(['message' => 'Product successfully added Wishlist', 'status' => 'success', 'wishcount' => $wishcount]);
            }else {
                return response()->json(['message' => 'Product already Wishlisted', 'status' => 'error']);
            }

        }else {
            return response()->json(['message' => 'At First Login Your Account', 'status' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product_id = $request->product_id;
        Wishlist::where('id', $id)->where('user_id', Auth::id())->where('product_id', $product_id)->delete();
        return redirect()->route('wish.show')->with('message','Wishlist successfully Deleted');
    }
}
