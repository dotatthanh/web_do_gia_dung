@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            width: 100%;
        }

        .sidebar {
            display: none;
        }

        #customer-info-wp .form-row .form-col {
            width: 100%;
            padding-right: 30px;
        }
    </style>
@endpush

@section('content')

    <div class="checkout-page">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <form method="POST" action="{{ frontendRouter('thanh-toan.post') }}" name="form-checkout"
                          enctype="multipart/form-data">
                        @csrf
                        @include('layouts.frontend.structures._notification')
                        @include('layouts.frontend.structures._error_validate')

                        <input type="hidden" name="total_money" value="{{$totalPriceCart}}">

                        <div class="form-row ">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên (*)</label>
                                <input type="text" name="name" placeholder="Nhập họ tên" value="{{ oldInput(old('name'), frontendCurrentUser() ? frontendCurrentUser()->username : '') }}" required>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-col fl-left">
                                <label for="phone">Số điện thoại (*)</label>
                                <input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{ oldInput(old('phone'), frontendCurrentUser() ? frontendCurrentUser()->phone : '') }}"
                                       required>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col fl-left">
                                <label for="phone">Địa chỉ (*)</label>
                                <input type="text" name="address" placeholder="Nhập địa chỉ" value="{{ oldInput(old('address'), frontendCurrentUser() ? frontendCurrentUser()->address : '') }}"
                                       required>
                            </div>
                        </div>

                        @if (count($cart) > 0)
                            <div class="place-order-wp clearfix">
                                <button class="btn btn-danger">Đặt hàng</button>
                                <a href="{{ frontendRouter('gio-hang') }}" class="btn btn-danger">Trở lại</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                        </thead>
                        <tbody>
                            @php 
                                $carts = Session::get('cart');
                            @endphp
                            @foreach($cart as $item)
                                <tr class="cart-item">
                                    <td class="product-name">
                                        <a style="color: black" href="{{ frontendRouter('san-pham', ['id' => $item->id]) }}">
                                            {{ $item->name }}
                                        </a></td>
                                    <td class="product-total" style="width: 130px">
                                        @if (!frontendCurrentUser())
                                            @foreach($carts as $cart)
                                                @if ($cart['product_id'] == $item->id)
                                                    @php
                                                        $amount = $cart['amount'];
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @else
                                            @php
                                            $amount = App\Model\Entities\Cart::where('user_id', frontendCurrentUser()->id)->where('product_id', $item->id)->first()->amount;
                                            @endphp
                                        @endif

                                        @if ($item->price_sell)
                                            {{ formatPriceCurrency($item->price_sell * $amount) }}
                                        @else
                                            {{ formatPriceCurrency($item->price_origin / 100 * (100 - $item->sale) * $amount) }}
                                        @endif
                                        đ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price text-danger">{{formatPriceCurrency($totalPriceCart)}} đ</strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection
