@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            width: 100%;
        }

        .sidebar {
            display: none;
        }
    </style>
@endpush

@section('content')

    <div class="cart-page">
        <div id="wrapper" class="wp-inner clearfix"> 

            @if (count($productInCarts) > 0)
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        @include('layouts.frontend.structures._notification')
                        <table class="table">
                            <thead>
                            <tr>
                                <td>STT</td>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td width="150">Size</td>
                                <td width="100">Số lượng</td>
                                <td>Giá</td>
                                <td>Thành tiền</td>
                                <td>Hành động</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php 
                                $carts = Session::get('cart');
                            @endphp
                            @foreach($productInCarts as $key => $item)
                                @if (!frontendCurrentUser())
                                    @foreach($carts as $cart)
                                        @if ($cart['product_id'] == $item->id)
                                            @php
                                                $amount = $cart['amount'];
                                                $size = $cart['size'];
                                            @endphp
                                        @endif
                                    @endforeach
                                @else
                                    @php
                                        $item_cart = App\Model\Entities\Cart::where('user_id', frontendCurrentUser()->id)->where('product_id', $item->id)->first();
                                        $amount = $item_cart->amount;
                                        $size = $item_cart->size;
                                    @endphp
                                @endif
                                <tr>
                                    <td>{{ 1 + $key }}</td>
                                    <td>#{{ $item->id }}</td>
                                    <td>
                                        <a title="" class="thumb">
                                            @if ($item->avatar)
                                                <img src="{{ asset($item->avatar) }}">
                                            @else
                                                <img src="{{ asset('image/lap-top-default.png') }}">
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ frontendRouter('san-pham', ['id' => $item->id]) }}" style="color: black"
                                           title="" class="name-product">{{ $item->name }}</a>
                                    </td>
                                    <td>
                                        @if($item->sizes->count())
                                            <select class="form-control" onchange="changeSize({{ $key }}, $(this).val())">
                                                @foreach($item->sizes as $item_size)
                                                <option value="{{ $item_size->name }}" @if($item_size->name == $size) selected @endif>{{ $item_size->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                    <td style="padding-left: 10px; padding-right:10px;">
                                        <input type="number" class="form-control" min="1" value="{{ $amount }}" onchange="changeAmount({{ $key }}, $(this).val())">
                                    </td>
                                    <td>
                                        @if ($item->price_sell)
                                            {{ formatPriceCurrency($item->price_sell) }}
                                        @else
                                            {{ formatPriceCurrency($item->price_origin / 100 * (100 - $item->sale)) }}
                                        @endif
                                        đ
                                    </td>

                                    <td class="sub-total">
                                        @if ($item->price_sell)
                                            {{ formatPriceCurrency($item->price_sell * $amount) }}
                                        @else
                                            {{ formatPriceCurrency($item->price_origin / 100 * (100 - $item->sale) * $amount) }}
                                        @endif
                                        đ
                                    </td>
                                    <td>
                                        @if (frontendCurrentUser())
                                            @php $cart = \App\Model\Entities\Cart::where('user_id', frontendCurrentUserId())->where('product_id', !empty($item->id) ? $item->id : '')->first(); @endphp
                                            <form method="post"
                                                  action="{{ frontendRouter('cart.update-item', $cart->id) }}" class="d-inline-block">
                                                @csrf

                                                <input hidden="" type="number" min="1" name="amount" id="amount-hidden{{ $key }}" value="{{ $amount }}">
                                                <input hidden type="text" min="1" name="size" id="size-hidden{{ $key }}" value="{{ $size }}">
                                                
                                                <button style="border: none" type="submit" title="Cập nhật sản phẩm"
                                                        class="del-product btn-success"><i class="fa fa-pencil"></i></button>
                                            </form>
                                            
                                            <form method="get"
                                                  action="{{ frontendRouter('cart.delete-item', ['id' => $cart->id]) }}" class="d-inline-block">
                                                @csrf
                                                <button style="border: none" type="submit" title="xoá sản phẩm"
                                                        class="del-product btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        @else
                                            <form method="post"
                                                  action="{{ frontendRouter('cart.update-item', $item->id) }}" class="d-inline-block">
                                                @csrf

                                                <input hidden="" type="number" min="1" name="amount" id="amount-hidden{{ $key }}" value="{{ $amount }}">
                                                <input hidden type="text" min="1" name="size" id="size-hidden{{ $key }}" value="{{ $size }}">
                                                <button style="border: none" type="submit" title="Cập nhật sản phẩm"
                                                        class="del-product btn-success"><i class="fa fa-pencil"></i></button>
                                            </form>

                                            <form method="get"
                                                  action="{{ frontendRouter('cart.delete-item', ['id' => $item->id]) }}" class="d-inline-block">
                                                @csrf
                                                <button style="border: none" type="submit" title="xoá sản phẩm"
                                                        class="del-product btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span class="total">{{ formatPriceCurrency($totalPriceCart) }} đ</span>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a class="btn btn-danger" href="{{ frontendRouter('thanh-toan') }}" title="" id="">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <a href="{{ frontendRouter('home') }}" title="mua tiếp" id="buy-more" class="text-danger">Mua tiếp</a><br>
                    </div>
                </div>
            @else
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title"><strong>Giỏ hàng trống.</strong></p>
                    </div>
                </div>

                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <a href="{{ frontendRouter('home') }}" title="mua tiếp" id="buy-more">Mua tiếp</a><br>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript">
        function changeAmount(key, val) {
            $(`#amount-hidden${key}`).val(val);
        }   
        function changeSize(key, val) {
            console.log(key, val);
            $(`#size-hidden${key}`).val(val);
        }    
    </script>
@endpush
