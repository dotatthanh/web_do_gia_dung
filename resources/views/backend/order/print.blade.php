<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In đơn hàng</title>

    <style>
        .text-center {
            text-align: center;
        }

        h5 {
            text-align: center;
            font-size: 32px;
        }

        table {
            width: 100%;
        }

        table td, th{
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <h5>Thông tin đơn hàng</h5>
    <table>
        <tbody>
            <tr>
                <td class="bold">Tên khách hàng</td>
                <td>{{ $entity->name }}</td>
            </tr>
            <tr>
                <td class="bold">SĐT</td>
                <td>{{ $entity->phone }}</td>
            </tr>

            <tr>
                <td class="bold">Địa chỉ</td>
                <td>{{ $entity->address }}</td>
            </tr>

            <tr>
                <td class="bold">Tổng số tiền (VNĐ)</td>
                <td>{{ formatPriceCurrency($entity->total_money) }}</td>
            </tr>

            <tr>
                <td class="bold">Trạng thái</td>
                <td>{!! getOrderStatus($entity->status)  !!}</td>
            </tr>
            <tr>
                <td class="bold">Trạng thái thanh toán</td>
                <td>{{ $entity->payment_status ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
            </tr>
        </tbody>
    </table>

    <h5>Danh sách sản phẩm</h5>

    <table>
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Giá (VNĐ)</th>
                <th scope="col">Số lượng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entity->orderDetails as $key => $value)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $value->product_name }}</td>
                <td>
                    @if ($value->product_avatar)
                    <img src="{{ asset($value->product_avatar) }}" alt="" width="50px">
                    @else
                    <img src="{{ asset('backend/image/no-image.jpg') }}" alt="" width="50px">
                    @endif
                </td>
                <td>
                    Giá gốc: {{ $value->product_price_origin }} <br>
                    Sale: {{ $value->product_sale }} % <br>
                    Giá bán: {{ $value->product_price_sell }} <br>
                </td>
                <td class="text-center">{{ $value->product_quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            window.print();
        });
    </script>
</body>
</html>



