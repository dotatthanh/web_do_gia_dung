<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController as BaseFrontendController;
use App\Model\Entities\Category;
use App\Model\Entities\Order;
use App\Model\Entities\OrderDetail;
use App\Model\Entities\Product;
use App\Model\Entities\Cart;
use App\Repositories\UserRepository;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Entities\Size;
ob_start();

class FrontendController extends BaseFrontendController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function index()
    {
        $productHot = Product::delFlagOn()->where('hot', getConfig('product-hot'))->take(8)->get();
        $category = Category::delFlagOn()->where('level', 1)->get();
        $data = [];

        foreach ($category as $key => $value) {
            $dataProduct = Product::with('category')->delFlagOn()->where('category_id', $value->id)->take(4)->get();

            array_push($data, $dataProduct);
        }

        $viewData = [
            'productHot' => $productHot,
            'data' => $data
        ];

        return view('frontend.index', $viewData);
    }

    public function gioiThieu()
    {
        $gioithieu = 'gioithieu';
        return view('frontend.gioi-thieu', compact('gioithieu'));
    }

    public function lienHe()
    {
        $lienhe = 'lienhe';
        return view('frontend.lien-he', compact('lienhe'));
    }

    public function sanPham($id)
    {
        $product = Product::delFlagOn()->with('category')->where('id', $id)->first();

        if (empty($product)) {
            abort(404);
        }
        $category  = Category::delFlagOn()->where('id', $product->category_id)->first();
        $relationProduct = Product::delFlagOn()->where('id', '!=', $id)->where('category_id', $product->category_id)->take(4)->get();

        $viewData = [
            'product' => $product,
            'category' => $category,
            'relationProduct' => $relationProduct
        ];

        return view('frontend.san-pham', $viewData);
    }

    public function danhSachDanhMuc()
    {
        return view('frontend.danh-muc');
    }
    public function baoMat()
    {
        $baomat = 'bao-mat';
        return view('frontend.chinh-sach-bao-mat', compact('baomat'));
    }
    public function vanChuyen()
    {
        $vanchuyen = 'van-chuyen';
        return view('frontend.chinh-sach-van-chuyen', compact('vanchuyen'));
    }
    public function baoHanh()
    {
        $baohanh = 'bao-hanh';
        return view('frontend.chinh-sach-bao-hanh', compact('baohanh'));
    }
    public function doiTra()
    {
        $doitra = 'doi-tra';
        return view('frontend.chinh-sach-doi-tra', compact('doitra'));
    }
    public function thanhToanPage()
    {
        $thanhtoan = 'thanh-toan';
        return view('frontend.chinh-sach-thanh-toan', compact('thanhtoan'));
    }
    public function suDung()
    {
        $sudung = 'su-dung';
        return view('frontend.quy-dinh-su-dung', compact('sudung'));
    }
    public function hdMuaHang()
    {
        $muahang = 'mua-hang';
        return view('frontend.huong-dan-mua-hang', compact('muahang'));
    }
    public function hdThanhToan()
    {
        $thanhtoan = 'thanh-toan';
        return view('frontend.huong-dan-thanh-toan', compact('thanhtoan'));
    }
    public function hdGiaoNhan()
    {
        $giaonhan = 'giao-nhan';
        return view('frontend.huong-dan-giao-nhan', compact('giaonhan'));
    }
    public function dkDichVu()
    {
        $dichvu = 'dich-vu';
        return view('frontend.dieu-khoan-dich-vu', compact('dichvu'));
    }


    public function showDanhMuc($id)
    {
        $category = Category::delFlagOn()->where('id', $id)->first();
        if (empty($category)) {
            abort(404);
        }
        $query = Product::delFlagOn()->where('category_id', $id);

        $params = request()->all();

        if (arrayGet($params, 'ram')) {
            $query->where('ram', arrayGet($params, 'ram'));
        }

        if (arrayGet($params, 'cpu')) {
            $query->where('cpu', arrayGet($params, 'cpu'));
        }

        if (arrayGet($params, 'price')) {
            $query->orderBy('price_origin', arrayGet($params, 'price'));
        }

        $products = $query->paginate(getFrontendPagination());
        $countProducts = $query->count();
        $viewData = [
            'category' => $category,
            'products' => $products,
            'countProducts' => $countProducts,
        ];
        return view('frontend.danh-muc', $viewData);
    }

    public function gioHang()
    {
        $userId = frontendCurrentUserId();
        $totalPriceCart = 0;
        if (!empty($userId)) {
            $cart = Cart::where('user_id', $userId)->pluck('product_id')->toArray();
            $carts = Cart::where('user_id', $userId)->get();

            foreach ($carts as $item_cart) {
                if ($item_cart->product->price_sell) {
                    $totalPriceCart += $item_cart->product->price_sell * $item_cart->amount;
                } else {
                    $totalPriceCart += $item_cart->product->price_origin * (100 - (int)$item_cart->product->sale) / 100 * $item_cart->amount;
                }
            }
        } else {
            $carts = session('cart', []);
            $cart = [];
            foreach ($carts as $value) {
                $product = Product::find($value['product_id']);
                if ($product->price_sell) {
                    $totalPriceCart += $product->price_sell * $value['amount'];
                } else {
                    $totalPriceCart += $product->price_origin * (100 - (int)$product->sale) / 100 * $value['amount'];
                }
                foreach ($value as $key => $result) {
                    if ($key == 'product_id')
                    {
                        array_push($cart, $result);
                    }
                }
            }
        }
        $productInCarts = Product::whereIn('id', $cart)->get();

        $viewData = [
            'productInCarts' => $productInCarts,
            'totalPriceCart' => $totalPriceCart,
        ];

        return view('frontend.gio-hang', $viewData);
    }

    public function thanhToan()
    {
        $totalPriceCart = 0;
        if (frontendCurrentUser()) {
            $cart = Cart::with('product')->where('user_id', frontendCurrentUserId())->pluck('product_id')->toArray();
            $carts = Cart::where('user_id', frontendCurrentUser()->id)->get();

            foreach ($carts as $item_cart) {
                if ($item_cart->product->price_sell) {
                    $totalPriceCart += $item_cart->product->price_sell * $item_cart->amount;
                } else {
                    $totalPriceCart += $item_cart->product->price_origin * (100 - (int)$item_cart->product->sale) / 100 * $item_cart->amount;
                }
            }
        } else {
            $cart = session('cart', []);
            $carts = session('cart', []);
            foreach ($carts as $value) {
                $product = Product::find($value['product_id']);
                if ($product->price_sell) {
                    $totalPriceCart += $product->price_sell * $value['amount'];
                } else {
                    $totalPriceCart += $product->price_origin * (100 - (int)$product->sale) / 100 * $value['amount'];
                }
                foreach ($value as $key => $result) {
                    if ($key == 'product_id')
                    {
                        array_push($cart, $result);
                    }
                }
            }
        }

        if (count($cart) <= 0) {
            return redirect()->route(frontendRouterName('home'));
        }

        $productInCarts = Product::whereIn('id', $cart)->get();

        $viewData = [
            'cart' => $productInCarts,
            'totalPriceCart' => $totalPriceCart
        ];

        return view('frontend.thanh-toan', $viewData);
    }

    public function thanhToanThanhCong(Request $request)
    {
        $order = Order::delFlagOn()->where('status', getConfig('pending'))->orderBy('id', 'desc')->first();
        $data = $request->all();
        if (isset($data['vnp_ResponseCode'])) {
            switch ($data['vnp_ResponseCode']) {
                case '00':
                    $order->update(['payment_status' => 1]);
                    break;
                case '07':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường).');
                case '09':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.');
                case '10':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần.');
                case '11':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Đã hết hạn chờ thanh toán. Vui lòng thực hiện lại giao dịch.');
                case '12':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Thẻ/Tài khoản của khách hàng bị khóa.');
                case '13':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Nhập sai mật khẩu xác thực giao dịch (OTP). Vui lòng thực hiện lại giao dịch.');
                case '24':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Khách hàng đã hủy giao dịch.');
                case '51':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Tài khoản không đủ số dư.');
                case '65':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Tài khoản đã vượt quá hạn mức giao dịch trong ngày.');
                case '75':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Ngân hàng thanh toán đang bảo trì. Vui lòng thử lại sau.');
                case '79':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Nhập sai mật khẩu thanh toán quá số lần quy định. Vui lòng thực hiện lại giao dịch.');
                case '99':
                    return redirect()->route(frontendRouterName('home'))->with('error', 'Giao dịch không thành công: Lỗi không xác định.');
                }
        }
        return view('frontend.thanh-toan-thanh-cong', compact('order'));
    }

    private function paymentVnpay($data_payment)
    {
        $vnp_TmnCode = env('VNP_TMNCODE'); //Mã website tại VNPAY 
        $vnp_HashSecret = env('VNP_HASH_SECRET'); //Chuỗi bí mật
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');

        $vnp_TxnRef = $data_payment['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán.';
        $vnp_OrderType = 'other';
        $vnp_Amount = $data_payment['amount'] * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    /**
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request, $productId)
    {
        try {
            $size = null;
            $userId = frontendCurrentUserId();
            $product = Product::find($productId);
            if ($product->sizes->count() && empty(request()->size)){
                $size = $product->sizes->first()->name;
            }
            else
            {
                $size = request()->size;
            }

            if (empty($userId)) {
                $carts = request()->session()->get('cart', []);

                if (in_array($productId, $carts)) {
                    return redirect()->back()->with('notification_error', 'Sản phẩm đã tồn tại trong giỏ hàng');
                }

                $product = [
                    'product_id' => $productId,
                    'size' => $size,
                    'amount' => 1
                ];

                array_push($carts, $product);
                request()->session()->put('cart', $carts);
            } else {
                $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

                if (!empty($cart)) {
                    return redirect()->back()->with('notification_error', 'Sản phẩm đã tồn tại trong giỏ hàng');
                }
                $cart = empty($cart) ? new Cart() : $cart;
                $cart->user_id = $userId;
                $cart->product_id = $productId;
                $cart->size = $size;
                $cart->amount = 1;
                $cart->save();
            }


            return redirect()->route('frontend.gio-hang');
        } catch (\Exception $e) {
            dd($e);
        }

        return backSystemError();
    }

    public function deleteItemCart($id)
    {
        try {
            if (frontendCurrentUser()) {
                $item = Cart::find($id);
                if (!empty($item)) {
                    $item->delete();
                }
            } else {
                $carts = session('cart', []);
                $tmp = [];
                foreach ($carts as $key => $value) {
                    foreach ($value as $key1 => $value1) {
                        if ($key1 == 'product_id' && $value1 != $id) {
                            array_push($tmp, $carts[$key]);
                        }
                    }
                }
                session()->put('cart', $tmp);
            }

            return backSystemSuccess();
        } catch (\Exception $e) {
        }

        return backRouteError();
    }

    public function postCheckout()
    {
        $params = request()->all();

        /** @var \App\Validators\UserValidator $validator */
        $validator = $this->getRepository()->getValidator();
        $isValid = $validator->frontendValidateStoreOrder($params);

        if (!$isValid) {
            return redirect()->back()->withErrors($validator->errors())->withInput($params);
        }

        DB::beginTransaction();
        try {
            // save to orders table
            $dataOrder = request()->all();
            $dataOrder['user_id'] = frontendCurrentUser() ? frontendCurrentUserId() : '';
            $dataOrder['name'] = request('name');
            $dataOrder['address'] = request('address');
            $dataOrder['phone'] = request('phone');
            $dataOrder['total_money'] = request('total_money');
            $dataOrder['status'] = getConfig('pending');
            $ordersEntity = Order::create($dataOrder);
            $orderId = $ordersEntity->getKey();

            // save to order_detail table
            $cart = frontendCurrentUser() ? Cart::where('user_id', frontendCurrentUserId())->get() : session('cart', []);
            foreach ($cart as $item) {
                $product = Product::delFlagOn()->where('id', $item['product_id'])->first();
                if (!empty($product)) {
                    if ($product->sizes->count() > 0) {
                        $size = Size::where([
                            'product_id' => $product->id,
                            'name' => $item['size']
                        ])->first();
                        $qty = $size->qty;
                    } else {
                        $qty = $product->qty;
                    }

                    if ($qty == 0) {
                        return redirect()->back()->with('notification_error', "Sản phẩm $product->name đã hết hàng");
                    }
                    if ($qty < $item['amount']) {
                        return redirect()->back()->with('notification_error', "Sản phẩm $product->name chỉ còn lại $qty sản phẩm");
                    }
                    $orderDetail['order_id'] = $orderId;
                    $orderDetail['product_id'] = $item['product_id'];
                    $orderDetail['product_name'] = $product->name;
                    $orderDetail['product_price_origin'] = $product->price_origin;
                    $orderDetail['product_price_sell'] = $product->price_sell ? $product->price_sell : $product->price_origin * (100 - $product->sale) / 100;
                    $orderDetail['product_sale'] = $product->sale;
                    $orderDetail['product_avatar'] = $product->avatar;
                    $orderDetail['product_quantity'] = $item['amount'];
                    $orderDetail['size'] = $item['size'];
                    OrderDetail::create($orderDetail);
                    if ($product->sizes->count() > 0) {
                        $size = Size::where([
                            'product_id' => $product->id,
                            'name' => $item['size']
                        ])->first();
                        $size->update(['qty' => $size->qty - $item['amount']]);
                    } else {
                        $product->update(['qty' => $product->qty - $item['amount']]);
                    }
                }
            }

            // remove cart by user id
            if (frontendCurrentUser()) {
                Cart::where('user_id', frontendCurrentUserId())->delete();
            } else {
                session()->forget('cart');
            }

            if (request('payment_method') == "Thanh toán VnPay") {
                $vnpayUrl = $this->paymentVnpay([
                    'order_id' => $ordersEntity->id,
                    'amount' => $ordersEntity->total_money,
                ]);
                DB::commit();
                return redirect($vnpayUrl);
            }

            DB::commit();
            return redirect()->route('frontend.thanh-toan-thanh-cong');
        } catch (\Exception $e) {
            logError($e);
            dd($e);
            DB::rollback();
        }
        return redirect()->back()->with('notification_error', 'Đã có lỗi sảy ra');
    }

    public function search()
    {
        $search = request('search');
        $query = Product::delFlagOn()->where('name', 'like', "%$search%");
        $products = $query->paginate(getFrontendPagination());
        $countProducts = $query->count();

        $viewData = [
            'products' => $products,
            'countProducts' => $countProducts,
        ];

        return view('frontend.search', $viewData);
    }

    public function updateItemCart(Request $request, $id)
    {
        if (frontendCurrentUser()) {
            $cart = Cart::find($id);
            $cart->update([
                'amount' => $request->amount,
                'size' => $request->size,
            ]);
        }
        else {
            $carts = session('cart');
            $tmp = [];
            $key_cart = 0;

            foreach ($carts as $key => $cart) {
                if ($cart['product_id'] == $id) {
                    $key_cart = $key;
                }
            }
            $carts[$key_cart]['amount'] = $request->amount;
            $carts[$key_cart]['size'] = $request->size;

            $request->session()->put('cart', $carts);
        }
        
        return redirect()->back();
    }
}
