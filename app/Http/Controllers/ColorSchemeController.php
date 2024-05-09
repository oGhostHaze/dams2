<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ColorSchemeController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function switch(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->color_scheme = $request->color_scheme;
        $user->save();

        return back();
    }
}
