<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private $result = array(
        'error' => false,
        'error_code' => 0,
        'error_desc' => '',
        'response' => null
    );

    public function login(LoginRequest $request, RegisterController $register_controller, User $user)
    {
        if (Auth::attempt($request->all())) {
            $this->result['response']['redirect'] = route('home');
            return response()->json($this->result);
        } else {
            $result = $user->where('username', $request->input('username'))->get()->toArray();
            if (empty($result)) {
                $register_controller->create($request->all());
                Auth::attempt($request->all());
                $this->result['response']['redirect'] = route('home');
            } else {
                $this->result['error'] = true;
                $this->result['error_code'] = 1;
                $this->result['error_desc'] = 'Incorrect login or password';
            }
            return $this->jsonResponse(true);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->result['response']['redirect'] = route('home');
        return $this->jsonResponse(true);
    }

    /**
     * @param $success
     */
    private function jsonResponse($success)
    {
        if ($success) {
            return response()->json($this->result);
        } else {
            return abort(500);
        }
    }
}
