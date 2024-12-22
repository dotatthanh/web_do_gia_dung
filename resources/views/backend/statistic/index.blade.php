@extends('layouts.backend.main')

@section('content')
    <div class="content-page teacher-page">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Thống kê</h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('layouts.backend.structures._notification')

                            <div class="card-body__head card-body__filter">
                                <h5 class="card-title bold">Bộ lọc</h5>
                            </div>

                            <!-- From search -->
                            <form method="GET" action="{{ backendRouter('statistic.index') }}" class="mb-5" id="form-search">
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                                    </div>
                                  

                                    {{-- <div class="col-md-2">
                                        <div class="my-select2">
                                            <select class="my-select2__select2 select2-wrapper" name="category_id">
                                                <option selected readonly value="">--- Danh mục ---</option>
                                                @foreach($categories as $item)
                                                    <option value="{{ arrayGet($item, 'id') }}" {{ request('category_id') == arrayGet($item, 'id') ? "selected" : '' }}>{{ arrayGet($item, 'name') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="my-select2">
                                            <select class="my-select2__select2 select2-wrapper" name="hot">
                                                <option selected readonly value="">--- SP Nổi bật ---</option>
                                                <option value="{{ getConfig('product-hot') }}" {{ !is_null(request('hot')) && request('hot') == getConfig('product-hot') ? "selected" : '' }}>Có</option>
                                                <option value="{{ getConfig('product-no-hot') }}" {{ !is_null(request('hot')) && request('hot') == getConfig('product-no-hot') ? "selected" : '' }}>Không</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="card-body__head card-body__filter text-center">
                                    <button type="submit" class="btn btn-cyan btn-sm">Tìm kiếm</button>
                                </div>
                            </form>

                            <div class="card-body__head d-flex">
                                <h5 class="card-title">Thống kê theo sản phẩm</h5>
                            </div>

                            <div id="zero_config_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <table class="table table-striped table-bordered dataTable" role="grid">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">STT</th>
                                            <th scope="col" class="text-center">Tên sản phẩm</th>
                                            <th scope="col" class="text-center">Số lượng đã bán</th>
                                            <th scope="col" class="text-center">Tổng tiền (VNĐ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $entity )
                                        <tr>
                                            <td class="text-center">{{ getSTTBackend($data, $key) }}</td>
                                            <td>{{ $entity->product_name }}</td>
                                            <td class="text-center">{{ formatPriceCurrency($entity->amount) }}</td>
                                            <td class="text-center">{{ formatPriceCurrency($entity->total) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
