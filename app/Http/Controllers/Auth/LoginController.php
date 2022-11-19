<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userrepository = null;
    public function __construct(UserRepository $userrepository)
    {
        $this->middleware('guest')->except('logout');
        $this->userrepository = $userrepository;
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!$this->userrepository->authenticate($credentials)){
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }else{
            return redirect('/home');
        }
        
    }

    public function loginView(){
        return view('auth.login');
    }

    // api login
    public function loginWithApi(Request $request){
        $validater = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        if($validater->fails()){
            return response()->json(['sts' => false, 'msg' => $validater->messages()->all()]);
        }else{
            if (!\Auth::attempt($request->only('email', 'password', 'role'))) {
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
            }
        
            $user = User::where(['email' => $request['email'] , 'role' => $request['role']])->firstOrFail();
        
            $token = $user->createToken('authToken')->plainTextToken;
        
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }
}
