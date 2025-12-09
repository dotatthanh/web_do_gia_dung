<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Brand;
use App\Model\Entities\Category;
use App\Model\Entities\Order;
use App\Model\Entities\Product;
use App\Model\Entities\Size;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use Illuminate\Support\Facades\File;

class OrderController extends BackendController
{
    public function __construct(OrderRepository $orderRepository)
    {
        $this->setRepository($orderRepository);
    }

    public function index()
    {
        $entities = Order::orderBy('id', 'desc')->paginate(getBackendPagination());

        $viewData = [
            'entities' => $entities
        ];

        return view('backend.order.index', $viewData);
    }

    public function show($id)
    {
        try {
            $entity = Order::delFlagOn()->with('orderDetails')->where('id', $id)->first();

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity
            ];

            return view('backend.order.show', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function edit($id)
    {
        try {
            $entity = Order::delFlagOn()->where('id', $id)->first();

            if (empty($entity)) {
                return backSystemError();
            }

            if (
                $entity->status == getConfig('delivered')
                || $entity->status == getConfig('cancel-by-admin')
                || $entity->status == getConfig('cancel-by-user')
            ) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity,
            ];

            return view('backend.order.edit', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function update($id)
    {
        try {
            $entity = Order::delFlagOn()->where('id', $id)->first();
            $entity->status = request('status');
            $entity->save();

            if (
                request('status') == getConfig('cancel-by-admin') ||
                request('status') == getConfig('cancel-by-user')
            ) {
                foreach ($entity->orderDetails as $orderDetails) {
                    $product = $orderDetails->product;

                    if ($product->sizes->count() > 0) {
                        $size = Size::where([
                            'product_id' => $product->id,
                            'name' => $orderDetails->size
                        ])->first();
                        $size->update(['qty' => $size->qty + 1]);
                    } else {
                        $product->update(['qty' => $product->qty + 1]);
                    }
                }
            }

            return backRouteSuccess('backend.order.index', transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function print($id)
    {
        try {
            $entity = Order::delFlagOn()->with('orderDetails')->where('id', $id)->first();

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity
            ];

            return view('backend.order.print', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }
}
