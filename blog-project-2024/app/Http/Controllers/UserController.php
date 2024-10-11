<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = new User();
        $allUsers = User::orderBy('name')->get();
        return view('backend.user_management.users.index', compact('user', 'allUsers'));
    }
}
