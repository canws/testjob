<?php

namespace App\Repositories;

use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function authenticate($credentials)
    {
        
        if (Auth::attempt($credentials)) {
            Session::regenerate($credentials);
        }
 
    }
}
