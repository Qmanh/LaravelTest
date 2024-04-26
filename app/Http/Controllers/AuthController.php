<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Repository\PostCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register()
    {
        return view('account.register');
    }

    public function login()
    {
        return view('front.login');
    }
    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('user.login')
            ->with('success','You successfully logged out!.');
    }

    public function userAuthenticate(Request $request)
    {
        if(Auth::attempt(['email'=> $request->email,'password'=> $request->password]
            ,$request->get('remember'))){

            if(session()->has('url.intended')){
                return redirect(session()->get('url.intended'));
            }

            return redirect()->route('homePage');
        }else{
            //session()->flash('error','Either email/password is incorrect.');
            return redirect()->route('user.login')
                ->withInput($request->only('email'))
                ->with('error','Either email/password is incorrect.');
        }
    }

    public function processRegister(Request $request)
    {
        return redirect()->back()->with(
            [
                "status"=>'true',
                "message"=>'Created account successfully',
                "data"=> $this->userRepo->create($request)
            ],
        );
    }

    //admin login, logout
    public function index(){
        return view('account.login');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if($validator->passes()){
            if(Auth::guard('admin')
                ->attempt(['email'=> $request-> email,'password'=> $request->password],
                    $request->get('remember'))) {

                $admin = Auth::guard('admin')->user();
                if($admin->role == 2){

                    return redirect()->route('admin.productList');
                }
                else{
                    Auth::guard('admin')->logout();
                    return redirect()->route('account.login')-> with('error','You are mpt authorized to access admin panel.');
                }

            }
            else{
                return redirect()->route('account.login')-> with('error','Either Email/Password is incorrect');
            }
        }else{
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('account.login');
    }
}
