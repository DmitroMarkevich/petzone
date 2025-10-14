<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(User $user)
    {
        $adverts = $user->adverts()->latest()->paginate(6);

        return view('user.show', compact('user', 'adverts'));
    }
}
