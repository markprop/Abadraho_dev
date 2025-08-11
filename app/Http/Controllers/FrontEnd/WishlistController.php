<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index() {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('wishlist', compact('wishlist'));
    }
    
    public function storewishlist($id) {
        // dd($postData->request); // $product_id = $request->product_id;
        $product_id = $id;
        if(Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->exists())
        {
            return response()->json(['status'=>'Project is already Added to Wishlist']);
        }
        else{
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::id();
            $wishlist->product_id = $product_id;
            $wishlist->save();
            return  response()->json(['status'=>'Project is Added to Wishlist']);
        }
         // return view('panel.admin.projects.search');
    }

    public function destroy(Wishlist $item) {
        Wishlist::destroy($item->id);
        return back()->with('success', 'Item has been removed from Wishlist');
    }
}
