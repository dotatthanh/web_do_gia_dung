<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Entities\OrderDetail;
use Illuminate\Database\Eloquent\Builder;
use DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
    	$data = OrderDetail::select(
    		'product_name',
    		DB::raw('SUM(product_quantity) as amount'),
    		DB::raw('SUM(product_price_sell*product_quantity) as total'),
    	)
    	->whereMonth('ins_date', date('m'))
    	->whereHas('order', function (Builder $query) {
		    $query->where('status', 2);
		})
		->groupBy('product_id')
		->paginate(getBackendPagination());

        if (isset($request->from_date)) {
            $data = OrderDetail::select(
                'product_name',
                DB::raw('SUM(product_quantity) as amount'),
                DB::raw('SUM(product_price_sell*product_quantity) as total'),
            )
            ->where('ins_date', '>=', date('Y-m-d', strtotime(($request->from_date))))
            ->whereHas('order', function (Builder $query) {
                $query->where('status', 2);
            })
            ->groupBy('product_id')
            ->paginate(getBackendPagination());
        }

        if (isset($request->to_date)) {
            $data = OrderDetail::select(
                'product_name',
                DB::raw('SUM(product_quantity) as amount'),
                DB::raw('SUM(product_price_sell*product_quantity) as total'),
            )
            ->where('ins_date', '<=', date('Y-m-d', strtotime(($request->to_date))))
            ->whereHas('order', function (Builder $query) {
                $query->where('status', 2);
            })
            ->groupBy('product_id')
            ->paginate(getBackendPagination());
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $data = OrderDetail::select(
                'product_name',
                DB::raw('SUM(product_quantity) as amount'),
                DB::raw('SUM(product_price_sell*product_quantity) as total'),
            )
            ->whereBetween('ins_date', [date('Y-m-d', strtotime(($request->from_date))), date('Y-m-d', strtotime(($request->to_date)))])
            ->whereHas('order', function (Builder $query) {
                $query->where('status', 2);
            })
            ->groupBy('product_id')
            ->paginate(getBackendPagination());
        }

		$data = [
			'data' => $data,
		];

		return view('backend.statistic.index', $data);
    }
}
