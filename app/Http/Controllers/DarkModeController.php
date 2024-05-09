<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DarkModeController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function switch()
    {
        $user = User::find(Auth::user()->id);
        $user->dark_mode = $user->dark_mode ? false : true;
        $user->save();
        return back();
    }
}
