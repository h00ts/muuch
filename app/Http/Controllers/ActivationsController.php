<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivationRepository;
use App\User;

class ActivationsController extends Controller
{
    public function store(Request $request, User $user)
    {
    	$actiation = ActivationRepository::createActivation($user);

    	return redirect()->back()->withSuccess('Se ha enviado la activación a: '.$user->name);
    }
}
