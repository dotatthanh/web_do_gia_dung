@extends('layouts.frontend.main')

@push('style')
    <style>
        .main-content {
            background: #fff;
            padding: 20px 15px;
        }

    </style>
@endpush

@section('content')
    @include('layouts.frontend.breadcrumb')


    <div class="section" id="detail-blog-wp">
        <div class="section-head clearfix">
            <h3 class="section-title">Giới Thiệu</h3>
        </div>
        <div class="section-detail">
            <div class="detail">
                <p>Cửa hàng đồ thể thao được thành lập tháng 7 năm 2025,
                    là cửa hàng chuyên buôn bán các sản phẩm
                    chất lượng chính hãng và các phụ kiện chuyên dụng
                    cho các sản phẩm thể thao …
                </p>

                <p>D-sport luôn tập trung xây dựng dịch vụ khách hàng khác
                    biệt với chất lượng vượt trội, phù hợp với văn hoá, đặt khách hàng
                    làm trung tâm trong mọi suy nghĩ và hành động của cửa hàng. D-sport
                    sẽ cung cấp tới mọi tầng lớp khách hàng những trải nghiệm mua sắm tích
                    cực, thông qua các sản phẩm Kỹ thuật số chính hãng chất
                    lượng cao, giá cả cạnh tranh đi kèm dịch vụ chăm sóc khách
                    hàng thân thiện, được đảm bảo bởi uy tín của doanh nghiệp.
                </p>

                <p>Sự tin tưởng và ủng hộ của khách hàng trong suốt thời gian qua là
                    nguồn động viên to lớn trên bước đường phát triển của D-SPORT. Chúng
                    tôi xin hứa sẽ không ngừng hoàn thiện, phục vụ khách hàng
                    tốt nhất để luôn xứng đáng với niềm tin ấy.
                </p>
            </div>
        </div>
        <div class="section" id="slider-wp">
            <div class="section-detail">
                <div class="item">
                    <img src="{{ asset('frontend/theme/image/slider_1.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('frontend/theme/image/slider_2.jpg') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('frontend/theme/image/slider_3.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
