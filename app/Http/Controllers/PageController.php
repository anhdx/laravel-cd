<?php
namespace App\Http\Controllers;
use App\Models\slide;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\User;
use App\Models\BillDetail;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Cookie;
use Validator;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\checkOutRequest;
use App\Http\Requests\searchRequest;
use App\Http\Requests\DetailRequest;
use App\Http\Requests\clientRequest;
use App\Http\Requests\checkLoginRequest;
use App\Http\Requests\checkRegisterRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = slide::all();
        $product = Product::where('id_type','>',0)->paginate(8);
        
        $p = Product::take(4)->get();
  
        return view('ui.index',['slide'=>$slide,
                                'product'=>$product,
                                'p'=>$p,
                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function category(){
        return view('ui.category');
    }
    public function getLogin(){
        return view('auth.login');
    }
    public function getRegister(){
        return view('auth.register');
    }
    public function postLogin(checkLoginRequest $rq){
      
        return redirect()->back()->with('fails','Sai tài khoản hoặc mật khẩu.');
    
    }
    public function postRegister(checkRegisterRequest $rq){ 
        $checkRegister = New User;
        $checkRegister->full_name = $rq->name;
        $checkRegister->email = $rq->email;
        $checkRegister->password = Hash::make($rq->password);
        $checkRegister->role = 0;
        $checkRegister->save();
        return redirect()->route('login')->with('notification','Bạn đã đăng ký thành công');

    }
    public function productDetail(){
        return view('ui.productDetail');
    }
    public function contact(){
        return view('ui.contacts');
    }
    public function addCart(Request $rq,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = New Cart($oldCart);
        $cart->add($product, $id);
        $rq->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function postContact(clientRequest $rq){

       
         return redirect()->back()->with('thanks','Cám ơn bạn đã đóng góp ý kiến, chúng tôi sẽ phản hồi bạn sớm nhất có thể. :v');
       }
    public function aboutUs(){
        return view('ui.about');
    }
    public function getCategory($id){
        $productCate = Product::where('id_type',$id)->get();
        $cate = Category::all();
        return view('ui.categoryDetail',compact('productCate','cate'));
    }
    public function detail(DetailRequest $rq)
    {
        $product = Product::where('id',$rq->id)->first();
        return view('ui.detail',compact('product'));
    }
    public function removeCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = New Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        
        return view('ui.order');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkOut(checkOutRequest $rq)
    {
        $cart = Session::get('cart');
        $Customer = New Customer;
        $Customer->name = $rq->name;
        $Customer->gender = $rq->gender;
        $Customer->email = $rq->email;
        $Customer->address = $rq->address;
        $Customer->phone_number = $rq->phone;
        $Customer->note = $rq->note;
        $Customer->save();
        $bill = New Bill;
        $bill->id_customer = $Customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $rq->payment_method;
        $bill->note = $rq->note;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            # code...
                $billDetail = New BillDetail;
                $billDetail->id_bill    = $bill->id;
                $billDetail->id_product = $key;
                $billDetail->quantity   = $value['qty'];
                $billDetail->unit_price = $value['price']/$value['qty'];
                $billDetail->save(); 
        }
         Session::forget('cart');
        return redirect()->route('home')->with('status','Đặt hàng thành công.');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Session::flush();
        Auth::logout();
     return redirect()->route('login');
    }
    public function search(searchRequest $rq){
        $productSearch = Product::where('name','like','%'.$rq->key.'%')->
                            orWhere('unit_price',$rq->key)
                            ->get();
         $slide = slide::all();
        $product = Product::where('id_type','>',0)->paginate(8);
        
        $p = Product::take(4)->get();
  
       
    return view('ui.search',['slide'=>$slide,
                                'product'=>$product,
                                'productSearch'=>$productSearch,
                                'p'=>$p,
                            ]);
    }
}
