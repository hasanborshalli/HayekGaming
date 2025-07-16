<?php
namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Coming;
use App\Models\ComingProduct;
use App\Models\GameType;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sentence;
use App\Models\SubCategory;
use Illuminate\Http\Request;
class PagesController extends Controller
{
    public function homePage()
    {
        $categories=Category::all();
$banners = Banner::orderBy('created_at', 'desc')->get();
        $newproducts = Product::where('is_available',true)
                              ->where('isNew',true)
                               ->orderBy('created_at', 'desc') 
                              ->latest()->take(5)->get();
        $featuredProducts = Product::where('featured', true)
                                   ->where('is_available',true)
                                    ->orderBy('created_at', 'desc') 
                                   ->take(5)->get();
        $comingSoon=Coming::first();
        $movingSentence=Sentence::first();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        $controllers=Product::where('category_id',1)->where('sub_category_id',5)->orderBy('created_at','desc')->take(7)->get();
        
        return view('home', ['categories' => $categories,'banners' => $banners,'newproducts'=>$newproducts,'featuredProducts' => $featuredProducts,'comingSoon'=>$comingSoon,'cartQuantity'=>$cartQuantity,'controllers'=>$controllers,'activeIndex' => 0,'movingSentence'=>$movingSentence->sentence]);
    }
    
    public function productDetailsPage(Product $product)
    {
                $movingSentence=Sentence::first();

        $categories=Category::all();
       $relatedProductsQuery = Product::where('category_id', $product->category_id)
       ->where('sub_category_id', $product->sub_category_id)
    ->where('is_available', true)
    ->where('id', '!=', $product->id)
    ->orderBy('created_at', 'desc');

if ($product->gameTypes()->exists()) {
    $gameTypeIds = $product->gameTypes->pluck('id')->toArray();

    $relatedProductsQuery->whereHas('gameTypes', function ($query) use ($gameTypeIds) {
        $query->whereIn('game_types.id', $gameTypeIds);
    });
}

$relatedProducts = $relatedProductsQuery->take(5)->get();

        $features=json_decode($product->features, true);
        $boxContents=json_decode($product->box_contents, true);
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        return view('productDetails', ['movingSentence'=>$movingSentence->sentence,'categories' => $categories,'relatedProducts'=>$relatedProducts,'product'=>$product,'features'=>$features,'boxContents'=>$boxContents,'cartQuantity'=>$cartQuantity]);
    }
    public function productsPage(Category $category)
    {
                $movingSentence=Sentence::first();

        $categories=Category::all();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        return view('productsPage', ['movingSentence'=>$movingSentence->sentence,'categories' => $categories,'category'=>$category,'cartQuantity'=>$cartQuantity]);
    }
public function productsBySubPage(SubCategory $subCategory)
{
    if ($subCategory->name === 'Games') {
        return redirect()->route('allGamesRoute', ['subCategory' => $subCategory->id]);
    }
            $movingSentence=Sentence::first();

    $categories = Category::all();
    $cart = session('cart_items', []);
    $cartQuantity = count($cart);
    $products=$subCategory->products()->orderBy('created_at','desc')->where('is_available',true)->paginate(24);
    return view('productsBySub', [
        'movingSentence'=>$movingSentence->sentence,
        'categories' => $categories,
        'subCategory' => $subCategory,
        'isGameType' => false,
        'cartQuantity' => $cartQuantity,
        'gameTypes' => [],
        'products'=>$products
    ]);
}

    public function productsByGameType(SubCategory $subCategory, GameType $gameType)
    {
                $movingSentence=Sentence::first();

                 $categories=Category::all();
                $gameTypes=GameType::all();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart); 

        $products = $gameType->products()
                             ->where('sub_category_id', $subCategory->id)
                             ->where('is_available',true)
                             ->orderBy('created_at', 'desc') 
                             ->paginate(24);
        
        return view('productsBySub', ['movingSentence'=>$movingSentence->sentence,'categories' => $categories,'gameType'=>$gameType,'isGameType'=>true,'products'=>$products,'subCategory'=>$subCategory,'gameTypes'=>$gameTypes,'cartQuantity'=>$cartQuantity]);
    }
    public function productsByAllGames(SubCategory $subCategory)
    {
                $movingSentence=Sentence::first();

        $categories=Category::all();
        $gameTypes=GameType::all();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart); 
        $products=$subCategory->products()->where('is_available',true)->orderBy('created_at', 'desc')->paginate(24);
        return view('productsBySub', ['movingSentence'=>$movingSentence->sentence,'categories' => $categories,'gameType'=>"All Games",'isGameType'=>true,'products'=>$products,'subCategory'=>$subCategory,'gameTypes'=>$gameTypes,'cartQuantity'=>$cartQuantity]);
    }
    public function loginPage()
    {
        return view('login');
    }
    public function adminPage()
    {
        return view('admin');
    }

    public function manageProductsPage()
    {
        $products=Product::where('is_available',true) ->orderBy('created_at', 'desc') ->paginate(24);
        $categories=Category::all();
        $gameTypes=GameType::all();
        return view('productsManage', ['products'=>$products,'categories'=>$categories,'gameTypes'=>$gameTypes]);
    
    }
    public function bannersPage()
    {
        $banners=Banner::all();
        return view('banners', ['banners'=>$banners]);
    }
    public function manageComingPage()
    {
        $image=Coming::first();
        $comingProducts=ComingProduct::paginate(24);
        return view('manageComing', ['image' => $image,'comingProducts'=>$comingProducts]);
    }
    public function changePasswordPage()
    {
        return view('changePassword');
    }
    public function addProductPage()
    {
        $categories=Category::all();
        $gameTypes=GameType::all();
        return view('addProduct', ['categories'=>$categories,'gameTypes'=>$gameTypes]);
    }
    public function addBannerPage()
    {
        $products=Product::where('is_available',true) ->orderBy('created_at', 'desc') ->get();
        return view('addBanner', ['products' => $products]);
    }
    public function editBannerPage(Banner $banner)
    {
        $products=Product::where('is_available',true) ->orderBy('created_at', 'desc') ->get();
        return view('editBanner', ['products' => $products,'banner' => $banner]);

    }
    public function editProductPage(Product $product)
    {
        $categories=Category::all();
        $gameTypes=GameType::all();
$decodedFeatures = json_decode($product->features ?? '[]', true);
$decodedBox = json_decode($product->box_contents ?? '[]', true);

$features = is_array($decodedFeatures) ? implode("\n", $decodedFeatures) : '';
$boxContents = is_array($decodedBox) ? implode("\n", $decodedBox) : '';

        $product_gameTypes=$product->gameTypes->pluck('id')->toArray();
        return view('editProduct', [
                                                'product'=>$product,
                                                'categories'=>$categories,
                                                'gameTypes'=>$gameTypes,
                                                'features'=>$features,
                                                'boxContents'=>$boxContents,
                                                'product_gameTypes'=>$product_gameTypes]);
    }
    public function cartPage()
    {
        $categories=Category::all();
        $movingSentence=Sentence::first();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        $itemIds = array_column($cart, 'id');
        $products=Product::whereIn('id', $itemIds)
                          ->where('is_available',true)
                           ->orderBy('created_at', 'desc') ->get();
        return view('cart', ['movingSentence'=>$movingSentence->sentence,'categories'=>$categories,'cartQuantity'=>$cartQuantity,'products'=>$products,'cart'=>$cart]);
    }
    public function checkoutPage()
    {
        $movingSentence=Sentence::first();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        $categories=Category::all();
        return view('checkout', ['movingSentence'=>$movingSentence->sentence,"cartQuantity"=>$cartQuantity,'categories'=>$categories]);
    }
    public function ThankyouPage(Request $request)
    {
                $movingSentence=Sentence::first();

        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        $categories=Category::all();
        $orderNumber=$request->input('orderNumber');;
        return view('thankyou', ['movingSentence'=>$movingSentence->sentence,"cartQuantity"=>$cartQuantity,'categories'=>$categories,'orderNumber'=>$orderNumber]);
    }
    public function OrdersPage()
    {
        $orders = Order::where('done', false)
               ->orderBy('created_at', 'desc')
               ->get();

        return view('manageOrders', ['orders'=>$orders]);
    }
    public function OrderPage(order $order)
    {
        if($order->done==false) {
            return view('orderDetails', ['order'=>$order]);

        } else {
            return redirect('/admin');

        }
    }
    public function EditOrderPage(order $order)
    {
        if($order->done==false) {
            return view('editOrder', ['order'=>$order]);

        } else {
            return redirect('/admin/orders');

        }
    }
    public function comingSoonPage()
    {
                $movingSentence=Sentence::first();

        $categories=Category::all();
        $cart = session('cart_items', []);
        $cartQuantity = count($cart);
        $comingSoonGames=ComingProduct::paginate(24);
        
        return view('comingSoon', ['movingSentence'=>$movingSentence->sentence,'categories' => $categories,'cartQuantity'=>$cartQuantity,'comingSoonGames'=>$comingSoonGames]);
    }
    public function sentencePage(){
    $sentence=Sentence::first();
        return view('sentenceManage',['sentence'=>$sentence->sentence]);
    }
}