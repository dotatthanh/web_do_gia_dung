<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Brand;
use App\Model\Entities\Category;
use App\Repositories\BrandRepository;
use Illuminate\Support\Facades\File;
use App\Validators\BrandValidator;

class BrandController extends BackendController
{
    public function __construct(BrandRepository $brandRepository)
    {
        $this->setRepository($brandRepository);
    }

    public function index()
    {
        $this->_clearSessionForm();
        $entities = Brand::delFlagOn()->get();

        $viewData = [
            'entities' => $entities
        ];

        return view('backend.brand.index', $viewData);
    }

    public function create()
    {
        return view('backend.brand.create');
    }

    public function store()
    {
        try {
            $params = request()->all();

            /** @var BrandValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateStoreBrand($params);

            if (!$isValid) {
                return redirect()->back()->withInput($params)->withErrors($validator->errors());
            }

            if (request()->hasFile('avatar')) {
                $fileName = time() . "_" . request()->file('avatar')->getClientOriginalName();
                $pathTmp = 'backend/uploads/brand/' . date('Y-m-d');
                $uploadPath = public_path($pathTmp); // Folder upload path

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                request()->file('avatar')->move($uploadPath, $fileName);
                $params['avatar'] = $pathTmp . '/' . $fileName;
            }

            $params['slug'] = createSlug(arrayGet($params, 'name'));
            $category = new Brand();
            $category->fill($params);
            $category->save();
            return backRouteSuccess('backend.brand.index', transMessage('create_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function edit($id)
    {
        try {
            $entity = Brand::delFlagOn()->where('id', $id)->first();

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity
            ];

            return view('backend.brand.edit', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function update($id)
    {
        try {
            $params = request()->all();

            $entity = Brand::delFlagOn()->where('id', $id)->first();
            if (empty($entity)) {
                return backSystemError();
            }

            /** @var \App\Validators\BrandValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateStoreBrand($params);

            if (!$isValid) {
                return redirect()->back()->withInput($params)->withErrors($validator->errors());
            }

            if (request()->hasFile('avatar')) {
                $fileName = time() . "_" . request()->file('avatar')->getClientOriginalName();
                $pathTmp = 'backend/uploads/brand/' . date('Y-m-d');
                $uploadPath = public_path($pathTmp); // Folder upload path

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                request()->file('avatar')->move($uploadPath, $fileName);
                $params['avatar'] = $pathTmp . '/' . $fileName;

                // Remove old file
                $oldImage = $entity->avatar;
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $params['slug'] = createSlug(arrayGet($params, 'name'));
            $entity->fill($params);
            $entity->save();

            return backRouteSuccess('backend.brand.index', transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function destroy($id)
    {
        try {
            $entity = Brand::delFlagOn()->where('id', $id)->first();
            if (empty($entity)) {
                return backSystemError();
            }
            $entity->del_flag = delFlagOff();
            $entity->save();
            return backSuccess(transMessage('delete_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }
}
