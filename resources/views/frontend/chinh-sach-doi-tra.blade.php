@extends('layouts.frontend.main')

@section('content')
    @include('layouts.frontend.breadcrumb')

    <div class="section change" id="detail-blog-wp">
        <img style="margin-bottom: 20px" src="{{ asset('frontend/theme/image/slider_4.jpg') }}" alt="">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-title category-title">
                <h1 class="title-head"><a href="#">Chính sách đổi trả</a></h1>
            </div>
            <div class="content-page rte">
                <h1><strong><span style="font-size:18px;"><a href="https://tienichxanh.com.vn/chinh-sach-doi-tra#"><span
                                    style="color:#000000;">Chính sách đổi trả</span></a></span></strong></h1>
                <p><strong>Quý khách hàng có thể gửi yêu cầu đổi trả sản phẩm tới địa điểm mua hàng với các trường hợp và
                        thời gian cụ thể sau:</strong></p>
                <p>1. Hàng hóa bị biến dạng, hỏng hóc do quá trình vận chuyển theo chính sách mua hàng của <b>DL
                        HCM</b>&nbsp;Tại thời điểm nhận hàng, quý khách hàng vui lòng kiểm tra sản phẩm và yêu cầu trả lại
                    nếu phát hiện lỗi hoặc không đúng sản phẩm đặt hàng.</p>
                <p>2. Sản phẩm bị hỏng hóc, biến dạng do lỗi sản xuất và chưa qua sử dụng.</p>
                <p>3. Cam kết đổi trả được quy định riêng đối với từng sản phẩm cụ thể.</p>
                <p><em>* Lưu ý: Sản phẩm yêu cầu đổi trả phải còn nguyên tem nguyên mác và trong thời gian còn bảo hành</em>
                </p>
            </div>
        </div>


    </div>
@endsection
