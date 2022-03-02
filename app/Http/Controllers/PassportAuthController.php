<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;

class PassportAuthController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(Request $request)
    {        
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $register = $this->userRepository->register($request);
        return $register;
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $login = $this->userRepository->login($request);
        
        return $login;
    }   
}
