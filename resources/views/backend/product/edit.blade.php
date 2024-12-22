@extends('layouts.backend.main')

@push('script')
    <script src="{{ asset('backend/js/pages/product.js') }}"></script>
@endpush

@section('content')
    <div class="content-page teacher-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title"></h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal repeater" action="{{backendRouter('product.update', ['id' => $entity->id])}}" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body__head d-flex">
                                    <h5 class="card-title">Cập nhật</h5>
                                    <a href="{{backendRouter('product.index')}}">
                                        <button type="button" class="btn btn-cyan btn-sm">Quay lại</button>
                                    </a>
                                </div>

                                <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="card">
                                            @csrf
                                            @method('PUT')

                                            @include('layouts.backend.structures._error_validate')
                                            @include('layouts.frontend.structures._notification')

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tên *</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="name"
                                                                       required value="{{ oldInput(old('name'), $entity->name)}}" placeholder="Nhập tên">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Số lượng *</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="qty"
                                                                       required value="{{ oldInput(old('qty'), $entity->qty)}}" placeholder="Nhập số lượng">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Giá gốc (VNĐ)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="price_origin"
                                                                       value="{{oldInput(old('price_origin'), $entity->price_origin)}}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Khuyến mại (%)</label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="sale"
                                                                       value="{{oldInput(old('sale'), $entity->sale)}}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Mô tả ngắn</label>
                                                            <div class="col-sm-8">
                                                            <textarea  type="text" class="form-control" maxlength="255" rows="5"
                                                                       name="sort_describe" placeholder="Nhập mô tả ngắn">{{ oldInput(old('sort_describe'), $entity->sort_describe) }} </textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Ảnh đại diện</label>
                                                            <div class="col-sm-8">
                                                                <input type="file" class="form-control" name="avatar" value="">
                                                                @if ($entity->avatar)
                                                                    <img src="{{ asset($entity->avatar) }}" alt="" width="150px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 text-right control-label col-form-label">Danh mục *</label>
                                                            <div class="col-md-8">
                                                                <div class="my-select2">
                                                                    <select class="select2-category-course select2-category-course-wrapper select2-wrapper" name="category_id">
                                                                        <option selected readonly value="">--- Vui lòng chọn ---</option>
                                                                        @foreach($category as $item)
                                                                            <option value = "{{ arrayGet($item, 'id') }}" {{ oldInput(old('category_id'), $entity->category_id) == arrayGet($item, 'id') ? "selected" : '' }}>
                                                                                {{ arrayGet($item, 'name') }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 text-right control-label col-form-label">Nổi bật</label>
                                                            <div class="col-md-8">
                                                                <div class="my-select2">
                                                                    <select class="select2-category-course select2-category-course-wrapper select2-wrapper" name="hot">
                                                                        <option selected readonly value="">--- Vui lòng chọn ---</option>
                                                                        @foreach(getConfig('product.hot') as $key => $value)
                                                                            <option value = "{{ $key }}" {{ oldInput(old('hot'), $entity->hot) == $key ? "selected" : '' }}>
                                                                                {{ $value }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Thêm size</h4>
                                {!! $errors->first('sizes', '<span class="error">:message</span>') !!}

                                <div data-repeater-list="sizes">
                                    @foreach ($entity->sizes as $size)
                                    <div data-repeater-item class="row">
                                        <div class="form-group col">
                                            <label for="use">Tên size</label>
                                            <input type="text" id="use" name="name" class="form-control" value="{{ $size->name }}">
                                        </div>

                                        <div class="col-lg-1">
                                            <label>Thao tác</label>
                                            <input data-repeater-delete="" type="button" class="btn btn-danger btn-block" value="Xóa">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <input data-repeater-create="" type="button" class="btn btn-success mt-3 mt-lg-0" value="Thêm">
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success">Gửi đi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@push('script')
    <!-- form repeater js -->
    <script src="{{ asset('libs\jquery.repeater\jquery.repeater.min.js') }}"></script>

    <script src="{{ asset('js\pages\form-repeater.int.js') }}"></script>

    <script src="{{ asset('libs\parsleyjs\parsley.min.js') }}"></script>

    <script src="{{ asset('js\pages\form-validation.init.js') }}"></script>
@endpush