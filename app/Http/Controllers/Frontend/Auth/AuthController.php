<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;

class AuthController extends FrontendController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function showFormLogin()
    {
        if (frontendIsLogin()) {
            return redirect()->route(frontendRouterName('home'));
        }

        return view('frontend.dang-nhap');
    }

    public function postLogin()
    {
        $credentials = [
            'email' => request('email'),
            'password' => request('password'),
            'del_flag' => delFlagOn()
        ];

        $checkLogin = frontendGuard()->attempt($credentials);

        if ($checkLogin) {
            return redirect()->route(frontendRouterName('home'));
        }

        return redirect()->back()->withErrors('Email hoặc Password không chính xác')->withInput(request()->all());
    }

    public function showFormRegister()
    {
        return view('frontend.dang-ki');
    }

    public function postRegister()
    {
        DB::beginTransaction();
        try {
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateStoreUser($params);

            if (!$isValid) {
                return redirect()->back()->withErrors($validator->errors())->withInput(request()->all());
            }

            $entity = new User();
            $params['password'] = bcrypt(arrayGet($params, 'password'));
            $entity->fill($params);
            $entity->save();

            DB::commit();
            return redirect()->route(frontendRouterName('login.get'))->with(['notification_success' => transMessage('create_success')]);
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
    }

    public function logout()
    {
        frontendGuard()->logout();
        return redirect()->route(frontendRouterName('login.get'));
    }

    public function forgotPassword()
    {
        return view('frontend.forgot-password');
    }

    // Quên mật khẩu
    public function postForgotPassword()
    {
        $params = request()->all();

        if ($params['email']) {
            $user = User::where('email', $params['email'])->first();
            if ($user) {
                $password = Str::random(8);
                $user->update([
                    'password' => bcrypt($password),
                ]);

                Mail::to($params['email'])->send(new ForgotPassword($password));
            }
            else {
                return redirect()->back()->with('notification_error', 'Tài khoản không tồn tại!');
            }
        }
        return redirect()->back()->with('notification_success', 'Mật khẩu mới đã được tới địa chỉ Email!');
    }
}
