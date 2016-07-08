<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterUser;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => 'required|min:2|max:60|unique:users',
            'name'     => 'required|min:2',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'nickname'     => $data['nickname'],
            'email'        => $data['email'],
            'name'         => $data['name'],
            'password'     => bcrypt($data['password']),
            'confirm_code' => str_random(30),
        ]);

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('auth.register', ['page' => 'register']);
    }

    public function showLoginForm()
    {
        return view('auth.login', ['page' => 'login']);
    }

    public function showResetForm()
    {
        return view('auth.passwords.email', ['page' => 'reset']);
    }

    public function confirmEmail(Request $request)
    {
        $confirm_code = $request->confirm_code;
        if (!empty($confirm_code)) {
            $user               = User::where('confirm_code', '=', $confirm_code)->first();
            $user->confirmed    = 1;
            $user->confirm_code = null;
            $user->save();
            session()->put('notify',
                [
                    ['text' => '<i class="uk-icon-exclamation"></i> Email confirmado com sucesso!', 'status' => 'success'],

                ]);
            auth()->login($user);
        }

        return redirect('/');
    }

    public function login(Request $request)
    {
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
        $request->merge([$field => $request->input('login')]);

        if (auth()->attempt($request->only($field, 'password'))) {
            return redirect('/game');
        }

        return redirect('/login')->with([
            'social_error' => 'These credentials do not match our records.',
        ]);
    }

    public function rules()
    {
        return [
            'login'    => 'required',
            'password' => 'required',
        ];
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->confirmed) {
            auth()->logout();
            return back()->with(['social_error' => 'You need to confirm your account. We have sent you an activation code, please check your email.']);
        }
        return redirect()->intended($this->redirectPath());
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());
        auth()->logout();

        return redirect('/login')->with(['social_error' => 'Confirme seu email.']);
    }
}
