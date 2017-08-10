<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InboxSend;
use Illuminate\Support\Facades\Mail;
use App\User;

class EmailsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postBuzon(Request $request)
    {
        $message = $request->input('message');
        $user = User::findOrFail($request->input('user_id'));
        Mail::to('fernanda@ilumexico.mx')->send(new InboxSend($user, $message));

        return redirect()->back();
    }
}
