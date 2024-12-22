<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ frontendRouter('home') }}">Home</a></li>
        @if (!empty($category))
            <li class="breadcrumb-item"><a
                    href="{{ frontendRouter('danh-muc', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
        @elseif(!empty($gioithieu))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('gioi-thieu') }}">Giới thiệu</a></li>
        @elseif(!empty($lienhe))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('lien-he') }}">Liên hệ</a></li>
        @elseif (!empty($baomat))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('chinh-sach-bao-mat') }}">Chính sách bảo mật</a>
            </li>
        @elseif (!empty($vanchuyen))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('chinh-sach-van-chuyen') }}">Chính sách vận
                    chuyển</a>
            </li>
        @elseif (!empty($baohanh))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('chinh-sach-bao-hanh') }}">Chính sách bảo hành</a>
            </li>
        @elseif (!empty($doitra))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('chinh-sach-doi-tra') }}">Chính sách đổi trả</a>
            </li>
        @elseif (!empty($thanhtoan))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('chinh-sach-thanh-toan') }}">Chính sách thanh
                    toán</a>
            </li>
        @elseif (!empty($sudung))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('quy-dinh-su-dung') }}">Quy định sử dụng</a>
            </li>
        @elseif (!empty($muahang))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('huong-dan-mua-hang') }}">Hướng dẫn mua hàng</a>
            </li>
        @elseif (!empty($thanhtoan))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('huong-dan-thanh-toan') }}">Hướng dẫn thanh toán</a>
            </li>
        @elseif (!empty($giaonhan))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('huong-dan-giao-nhan') }}">Hướng dẫn giao nhận</a>
            </li>
        @elseif (!empty($dichvu))
            <li class="breadcrumb-item"><a href="{{ frontendRouter('dieu-khoan-dich-vu') }}">Điều khoản dịch vụ</a>
            </li>
        @endif
        @if (!empty($product))
            <li class="breadcrumb-item"><a
                    href="{{ frontendRouter('san-pham', ['id' => $product->id]) }}">{{ $product->name }}</a>
            </li>
        @endif

    </ol>
</nav>
