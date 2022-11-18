<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $result['users'] = User::orderBy('id', 'desc')->paginate(5);
        return view('admin.index')->with($result);
    }
}
