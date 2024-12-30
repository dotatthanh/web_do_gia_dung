@extends('layouts.frontend.main')

@section('content')
    @include('layouts.frontend.breadcrumb')

    <div class="section secure" id="detail-blog-wp">
        <img style="margin-bottom: 20px" src="{{ asset('frontend/theme/image/slider_4.jpg') }}" alt="">


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="page-title category-title">
                <h1 class="title-head"><a href="#">Chính sách vận chuyển</a></h1>
            </div>
            <div class="content-page rte">
                <p><strong>Chính sách vận chuyển :</strong><br>
                    <u>Quy trình giao nhận vận chuyển :&nbsp;</u>
                </p>
                <p><strong>+ DL HCM</strong>&nbsp;thực hiện giao hàng trên toàn quốc theo bảng phí vận chuyển&nbsp;<br>
                    Khi quý khách hàng đặt hàng thành công qua website,&nbsp;<strong>DL HCM</strong>&nbsp;sẽ tiến hành
                    giao hàng theo yêu cầu của quý khách hàng:</p>
                <p>+ Giao hàng tận nơi dự kiến 2 - 3 ngày làm việc tại Nội thành Hà Nội và thành phố Hồ Chí Minh.<br>
                    Từ 3 - 5 ngày cho các tỉnh thành khác trên cả nước.</p>
                <p>+ Trong trường hợp đơn đặt hàng phát sinh chậm trễ trong việc giao hàng hoăc cung ứng dịch
                    vụ,&nbsp;<strong>DL HCM</strong>&nbsp;sẽ liên hệ trực tiếp khách hàng để nắm thông tin và xử lý.</p>
                <p dir="ltr">+<strong>DL HCM</strong>&nbsp;liên kết với đơn vị vận chuyển phù hợp&nbsp;nhằm cung cấp cho
                    gian hàng dịch vụ vận chuyển, giao hàng thu tiền tin cậy và hiệu quả nhất.</p>
                <p dir="ltr">+ Các đơn hàng vận chuyển mà gian hàng xác nhận vận chuyển qua hệ thống của&nbsp;<strong>DL
                     HCM</strong>&nbsp;sẽ được chuyển tới hãng vận chuyển để xử lý, lấy hàng, giao hàng:</p>
                <p>+ Giao hàng toàn quốc, nhận hàng, kiểm hàng mới thanh toán.<br>
                    <br>
                    + Phí giao hàng nội thành Hà Nội 25K, toàn quốc 30K.&nbsp;
                </p>
            </div>
        </div>
    </div>
@endsection
