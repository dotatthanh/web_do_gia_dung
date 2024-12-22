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

<div class="section" id="detail-blog-wp">
    <div class="section-head clearfix">
        <h3 class="section-title">Quên mật khẩu</h3>
    </div>
    <div class="section-detail">
        <div class="detail">
            <div class="row">
                <div class="col-sm-6">
                    <form class="form-horizontal" method="POST" action="{{ frontendRouter('post.forgot.password') }}" enctype="multipart/form-data">
                        @csrf

                        @if (Session::has('notification_success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <ul>
                                    <li>{{ session()->get('notification_success') }}</li>
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (Session::has('notification_error'))
                            <div class="error alert alert-danger">
                                <ul>
                                    <li>{{ session()->get('notification_error') }}</li>
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Nhập email" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Submit</button>
                        <a href="{{ frontendRouter('login.get') }}">Đăng nhập</a>
                        <p>Đăng nhập để nhận ưu đãi</p>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
