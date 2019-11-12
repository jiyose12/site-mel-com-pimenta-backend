<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }
        /**
     * Handle a registration request for the application. CODIGO VINDO DE RegisterUsers.php
     */
    public function register(Request $request)
    {
        $hashed = Hash::make($request->password);
        $credentials = $request->only('email', 'password');
        $validator = $this->validator($request->all());
        if(!$validator->fails()){
            $user = $this->create($request->all());
            // $token = $this->auth->attempt($request->email,$hashed);

            //modificado auth.php api para de token para jwt
            //tbm foi adicionado em Kernel.php $routeMiddleware
            $token = auth('api')->attempt($credentials);

            return response()->json([
                'success' => true,
                'data' => $user,
                'token' => $token
            ], 200);
        }
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ]);
    //     $credentials = request(['email', 'password']);
    // if (!$token = auth('api')->attempt($credentials)) {
    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }
    // return response()->json([
    //     'token' => $token,
    //     'expires' => auth('api')->factory()->getTTL() * 60,
    // ]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
