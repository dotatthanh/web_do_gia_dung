<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>{{ getSiteName() }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="TzivisrDQXT5IWYg46zXshgyZAFn8LYCqFgz72qR">
    <link rel="icon" type="image/png" href="{{ asset('image/logo-sunhouse-nho.png') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/vendor/bootstrap4.5.2/bootstrap-theme.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap4.5.2/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/theme/css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/carousel/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/carousel/owl.theme.css') }} ">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/vendor/font-awesome/css/font-awesome.min.css') }} " />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/theme/css/style.css') }} " />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/theme/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/common.css') }}" />

    @stack('style')
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner clearfix">
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{ frontendRouter('home') }}" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('gioi-thieu') }}" title="">Giới thiệu</a>
                                </li>
                                {{-- <li>
                                    <a href="{{ frontendRouter('lien-he') }}" title="">Liên hệ</a>
                                </li> --}}

                                @if (frontendCurrentUser())
                                    <li>
                                        <a href="{{ frontendRouter('account') }}" title="">Tài khoản</a>
                                    </li>

                                    <li>
                                        <a href="{{ frontendRouter('account.order.history') }}" title="">Đơn hàng</a>
                                    </li>

                                    <li>
                                        <a href="{{ frontendRouter('logout') }}" title="">Đăng xuất</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ frontendRouter('login.get') }}" title="Đăng nhập để nhận ưu đãi">Đăng nhập</a>
                                    </li>

                                    <li>
                                        <a href="{{ frontendRouter('register.get') }}" title="">Đăng kí</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner clearfix">
                        <!-- @todo -->
                        <a href="{{ frontendRouter('home') }}" title="" id="logo" class="fl-left bg-white">
                            <img src="{{ asset('image/logo-sunhouse-nho.png') }}" style="object-fit: cover" />
                        </a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="{{ frontendRouter('tim-kiem') }}"
                                style="position: relative; z-index: 11;">
                                @csrf
                                <input type="text" name="search" value="{{ request('search') }}" id="s"
                                    placeholder="Nhập sản phẩm tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0123.456.789</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars"
                                    aria-hidden="true"></i></div>
                            <a href="{{ frontendRouter('gio-hang') }}" title="giỏ hàng" id="cart-respon-wp"
                                class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num"
                                    class="num-pd">{{ arrayGet($viewComposer, 'numberItemInCart') }}</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="{{ frontendRouter('gio-hang') }}">
                                        <i class="fa fa-shopping-cart" aria-hidden="true" style="color: white"></i></a>
                                    <span id="num"
                                        class="num-pd">{{ arrayGet($viewComposer, 'numberItemInCart') }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END-Header -->
            <div id="main-content-wp" class="home-page">
                <div class="wp-inner clearfix">
                    <div class="main-content fl-right">
                        @yield('content')
                    </div>

                    <div class="sidebar fl-left">
                        <div class="section" id="category-product-wp">
                            <div class="section-head">
                                <h3 class="section-title">Danh mục sản phẩm</h3>
                            </div>
                            <div class="secion-detail">
                                <ul class="list-item">
                                    @foreach (arrayGet($viewComposer, 'categories') as $category)
                                        @if ($category->level != 1)
                                            @continue
                                        @endif
                                        <li>
                                            <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}"
                                                title="">{{ $category->name }}</a>
                                            @if ($category->children()->count() > 0)
                                                <ul class="sub-menu">
                                                    @foreach ($category->children as $child)
                                                        <li>
                                                            <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}"
                                                                title="">{{ $child->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="section" id="selling-wp">
                            <div class="section-head">
                                <h3 class="section-title">Sản phẩm bán chạy</h3>
                            </div>
                            <div class="section-detail">
                                <ul class="list-item">
                                    @foreach (arrayGet($viewComposer, 'mostSellProduct') as $key => $order)
                                        @php $product = $order->tryGet('product'); @endphp
                                        <li class="clearfix">
                                            <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}"
                                                title="" class="thumb fl-left">
                                                @if ($product->avatar)
                                                    <img src="{{ asset($product->avatar) }}" width="72px">
                                                @else
                                                    <img src="{{ asset('image/lap-top-default.png') }}" width="72px">
                                                @endif
                                            </a>
                                            <div class="info fl-right">
                                                <a href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}"
                                                    title="" class="product-name">{{ $product->name }}</a>
                                                <div class="price">
                                                    <span class="new">
                                                        @if ($product->price_sell)
                                                            {{ formatPriceCurrency($product->price_sell) }}
                                                        @else
                                                            {{ formatPriceCurrency(($product->price_origin / 100) * (100 - $product->sale)) }}
                                                        @endif
                                                        đ
                                                    </span>
                                                    @if ($product->sale)
                                                        <span class="new"> - {{ $product->sale }}%</span>
                                                    @endif
                                                </div>
                                                <small>( {{ $order->count }} sản phẩm )</small>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="section" id="banner-wp">
                            <div class="section-detail">
                                <a href="{{ frontendRouter('home') }}" title="" class="thumb">
                                    <img src="{{ asset('frontend/theme/image/banner.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- END-Content -->
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            {{-- <h3 class="title">CỬA HÀNG ĐỒ THỂ THAO</h3>
                            <h3 class="title" style="text-align:center">D-Sport</h3> --}}
                            <div class="text-center">
                                <a href="/" class="d-inline-block">
                                    <img src="{{ asset('image/logo-sunhouse-nho.png') }}"/>
                                </a>
                            </div>
                            <p class="desc">ĐỒ THỂ THAO luôn cung cấp luôn là sản phẩm chính hãng có thông tin
                                rõ ràng, chính
                                sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img class="img-fluid"
                                        src="{{ asset('frontend/theme/image/img-foot.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>Hà Nội</p>
                                </li>
                                <li>
                                    <p>0123.456.789</p>
                                </li>
                                <li>
                                    <p>dothethao@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="policy">
                            <h3 class="title">Chính sách</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="{{ frontendRouter('chinh-sach-bao-mat') }}">Chính sách bảo mật</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('chinh-sach-van-chuyen') }}">Chính sách vận chuyển</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('chinh-sach-bao-hanh') }}">Chính sách bảo hành</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('chinh-sach-doi-tra') }}">Chính sách đổi trả</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('chinh-sach-thanh-toan') }}">Chính sách thanh toán</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('quy-dinh-su-dung') }}">Quy định sử dụng</a>
                                </li>


                            </ul>
                        </div>
                        <div class="block" id="instruction">
                            <h3 class="title">Hướng dẫn</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="{{ frontendRouter('huong-dan-mua-hang') }}">Hướng dẫn mua hàng</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('huong-dan-thanh-toan') }}">Hướng dẫn thanh toán</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('huong-dan-giao-nhan') }}">Hướng dẫn giao nhận</a>
                                </li>
                                <li>
                                    <a href="{{ frontendRouter('dieu-khoan-dich-vu') }}">Điều khoản dịch vụ</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">© Bản quyền thuộc về dothethao</p>
                    </div>
                </div>
            </div>
            <!-- END-Footer -->
        </div>
        <!-- END-Container -->
        <div id="menu-respon">
            <a title="" class="logo bg-secondary"><img src="{{ asset('image/logo-sunhouse-nho.png') }}" /></a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    @foreach (arrayGet($viewComposer, 'categories') as $category)
                        @if ($category->level != 1)
                            @continue
                        @endif
                        <li>
                            <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}"
                                title="">{{ $category->name }}</a>
                            @if ($category->children()->count() > 0)
                                <ul class="sub-menu">
                                    @foreach ($category->children as $child)
                                        <li>
                                            <a href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}"
                                                title="">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- END-Menu-respon -->

        <div id="btn-top"><img class="img-fluid" src="{{ asset('frontend/theme/image/icon-to-top.png') }}"
                alt="" /></div>
        <div id="fb-root"></div>
        <!-- The-END -->
    </div>
    <script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery.ez-plus.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/vendor/easyzoom/easyzoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/vendor/popper/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery.elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/vendor/bootstrap4.5.2/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/vendor/carousel/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/theme/main.js') }} "></script>
    <script type="text/javascript" src="{{ asset('backend/libs/loadingoverlay/loadingoverlay.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/common.js') }}"></script>

    @stack('script')

</body>

</html>
