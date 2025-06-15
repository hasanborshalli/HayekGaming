<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GameType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        
        $fields=$request->validate([
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'nullable|exists:subcategories,id',
        'name' => 'required|string|max:20',
        'title' => 'required|string|max:30',
        'price' => 'required|numeric|min:0',
        'featured' => 'required|in:yes,no',
        'headline' => 'required|string|max:255',
        'description' => 'required|string',
        'features' => 'required|string',
        'box_contents' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=700,height=880',
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'image4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'gameTypes' => 'nullable|array',
        'gameTypes.*' => 'string'
        ]);
        $mainImage=$request->file('image');
        $customName='Product-'.Str::uuid().'.webp';
        $mainImage->storeAs('products', $customName);
        $fields['image']=$customName;

        foreach (['image1', 'image2', 'image3', 'image4'] as $img) {
            if($request[$img]) {
                $customName='Product-'.Str::uuid().'.webp';
                $request->file($img)->storeAs('products', $customName);
                $fields[$img]=$customName;
            }
        }
        $fields['features']=json_encode(explode("\n", trim($fields['features'])));
        
        if($request->box_contents) {
            $fields['box_contents']=json_encode(explode("\n", trim($fields['box_contents'])));
        } else {
            $fields['box_contents']=null;
        }
        
        if($fields['featured']=='yes') {
            $fields['featured']=true;
        } else {
            $fields['featured']=false;
        }
        
        $product=Product::create($fields);
        if ($request->has('gameTypes')) {
            $gameTypeIds = GameType::whereIn('name', $request->gameTypes)->pluck('id');
            $product->gameTypes()->sync($gameTypeIds);
        }
        return redirect('/admin/products')->with('message', 'Product Added Successfully');
    }
    public function editProduct(Request $request, Product $product)
    {
        $fields=$request->validate([
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'nullable|exists:subcategories,id',
        'name' => 'required|string|max:20',
        'title' => 'required|string|max:30',
        'price' => 'required|numeric|min:0',
        'featured' => 'required|in:yes,no',
        'is_available' => 'required|in:yes,no',
        'headline' => 'required|string|max:255',
        'description' => 'required|string',
        'features' => 'required|string',
        'box_contents' => 'nullable|string',
        'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=700,height=880',
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'image4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=400,height=400',
        'gameTypes' => 'nullable|array',
        'gameTypes.*' => 'string'
        ]);
        foreach (['image','image1', 'image2', 'image3', 'image4'] as $img) {
            if($request[$img]) {
                if ($product->$img && Storage::exists('products/' . $product->image)) {
                    Storage::delete('products/' . $product->image);
                }
                $customName='Product-'.Str::uuid().'.webp';
                $request->file($img)->storeAs('products', $customName);
                $fields[$img]=$customName;
            }
        }
        $fields['features']=json_encode(explode("\n", trim($fields['features'])));
        
        if($request->box_contents) {
            $fields['box_contents']=json_encode(explode("\n", trim($fields['box_contents'])));
        } else {
            $fields['box_contents']=null;
        }
        
        if($fields['featured']=='yes') {
            $fields['featured']=true;
        } else {
            $fields['featured']=false;
        }
        
        if($fields['is_available']=='yes') {
            $fields['is_available']=true;
        } else {
            $fields['is_available']=false;
        }
        $product->update($fields);
        if ($request->has('gameTypes')) {
            $gameTypeIds = GameType::whereIn('name', $request->gameTypes)->pluck('id');
            $product->gameTypes()->sync($gameTypeIds);
        } else {
            // Remove all associated game types if none are provided
            $product->gameTypes()->sync([]);
        }
        return redirect('/admin/products')->with('message', 'Product Edited Successfully');

    }
    public function deleteProduct(Product $product)
    {
        foreach ([$product->image,$product->image1,$product->image2,$product->image3,$product->image4] as $img) {
                if ($product->$img && Storage::exists('products/' . $product->image)) {
                    Storage::delete('products/' . $product->image);
                }
        }
        $product->delete();
        return response()->json(['status'=>"removed"]);
    }
    public function productsSearch(Request $request)
    {
        $fields=$request->validate([
           'search'=>['required','max:255']
        ]);
        $products=Product::search($fields['search'])->where('is_available',true)->paginate(10);
        $categories=Category::all();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        return view('productsSearch', ['products'=>$products,'categories'=>$categories,'search'=>$fields['search'],'cartQuantity'=>$cartQuantity]);
    }
    public function adminProductsSearch(Request $request)
    {
        $fields=$request->validate([
           'search'=>['required','max:255']
        ]);
        $products=Product::search($fields['search'])->where('is_available',true)->paginate(20);
        $categories=Category::all();
        $gameTypes=GameType::all();
        return view('productsManage', ['products'=>$products,'categories'=>$categories,'gameTypes'=>$gameTypes]);
    }
    public function getSubCategories(Category $category)
    {
        $subCategories=$category->subcategories;
        return response()->json($subCategories);
    }
    public function adminFilter(Request $request)
    {
        
        $query = Product::with(['category', 'subCategory', 'gameTypes']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('subcategory_id') && $request->subcategory_id != 0) {
            $query->where('sub_category_id', $request->subcategory_id);
        }

        if ($request->filled('gameTypes') && is_array($request->gameTypes)) {
            $query->whereHas('gameTypes', function ($q) use ($request) {
                $q->whereIn('name', $request->gameTypes);
            });
        }
        $products = $query->where('is_available',true)->paginate(20);
        $categories=Category::all();
        $gameTypes=GameType::all();
        return view('productsManage', ['products'=>$products,'categories'=>$categories,'gameTypes'=>$gameTypes]);
    }
    public function filter(Request $request)
    {
        $selectedGameTypeIds = $request->input('gameTypes', []);
        $subCategoryId = $request->input('subCategoryId');

        if (empty($selectedGameTypeIds) || !$subCategoryId) {
            return redirect()->back()->with('message', 'Missing filters.');
        }

        // Get names for search statement
        $selectedGameTypeNames = GameType::whereIn('id', $selectedGameTypeIds)->pluck('name')->toArray();
        $searchStatement = implode(', ', $selectedGameTypeNames);

        // Filter products by both subcategory and game types
        $products = Product::where('sub_category_id', $subCategoryId)->where('is_available',true)
            ->whereHas('gameTypes', function ($query) use ($selectedGameTypeIds) {
                $query->whereIn('game_types.id', $selectedGameTypeIds);
            })
            ->with('gameTypes', 'category')
            ->paginate(10);
        $categories=Category::all();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        return view('productsSearch', ['products'=>$products,'categories'=>$categories,'search'=>$searchStatement,'cartQuantity'=>$cartQuantity]);

    }
}