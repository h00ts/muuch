<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $phone = $request->input('phone');
        $user = User::findOrFail($request->input('id'));
        $user->phone = $phone;
        $user->save();

        return response()->json([
            'name' => $user->name,
            'phone' => $phone
        ]);
    }
}
