@extends('layouts.frontend.main')

@section('content')
    @include('layouts.frontend.breadcrumb')

    <div class="section secure" id="detail-blog-wp">
        <img style="margin-bottom: 20px" src="{{ asset('frontend/theme/image/slider_4.jpg') }}" alt="">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-title category-title">
                <h1 class="title-head"><a href="#">Hướng dẫn</a></h1>
            </div>
            <div class="content-page rte">
                <p style="text-align: justify;"><strong>Bước 1:</strong> Truy cập website và lựa chọn sản phẩm cần mua để
                    mua hàng</p>

                <p style="text-align: justify;"><strong>Bước 2:</strong> Click và sản phẩm muốn mua, màn hình hiển thị ra
                    pop up với các lựa chọn sau</p>

                <p style="text-align: justify;">Nếu bạn muốn tiếp tục mua hàng: Bấm vào phần tiếp tục mua hàng để lựa chọn
                    thêm sản phẩm vào giỏ hàng</p>

                <p style="text-align: justify;">Nếu bạn muốn xem giỏ hàng để cập nhật sản phẩm: Bấm vào xem giỏ hàng</p>

                <p style="text-align: justify;">Nếu bạn muốn đặt hàng và thanh toán cho sản phẩm này vui lòng bấm vào: Đặt
                    hàng và thanh toán</p>

                <p style="text-align: justify;"><strong>Bước 3:</strong> Lựa chọn thông tin tài khoản thanh toán</p>

                <p style="text-align: justify;">Nếu bạn đã có tài khoản vui lòng nhập thông tin tên đăng nhập là email và
                    mật khẩu vào mục đã có tài khoản trên hệ thống</p>

                <p style="text-align: justify;">Nếu bạn chưa có tài khoản và muốn đăng ký tài khoản vui lòng điền các thông
                    tin cá nhân để tiếp tục đăng ký tài khoản. Khi có tài khoản bạn sẽ dễ dàng theo dõi được đơn hàng của
                    mình</p>

                <p style="text-align: justify;">Nếu bạn muốn mua hàng mà không cần tài khoản vui lòng nhấp chuột vào mục đặt
                    hàng không cần tài khoản</p>

                <p style="text-align: justify;"><strong>Bước 4:</strong> Điền các thông tin của bạn để nhận đơn hàng, lựa
                    chọn hình thức thanh toán và vận chuyển cho đơn hàng của mình</p>

                <p style="text-align: justify;"><strong>Bước 5:</strong> Xem lại thông tin đặt hàng, điền chú thích và gửi
                    đơn hàng</p>

                <p style="text-align: justify;">Sau khi nhận được đơn hàng bạn gửi chúng tôi sẽ liên hệ bằng cách gọi điện
                    lại để xác nhận lại đơn hàng và địa chỉ của bạn.</p>

                <p style="text-align: justify;">Trân trọng cảm ơn.</p>
            </div>
        </div>

    </div>
@endsection
