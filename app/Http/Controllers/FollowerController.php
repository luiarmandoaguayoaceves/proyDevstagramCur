<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User  $user, Request $request)
    {

        $user->followers()->attach(auth()->user()->id);
        return redirect()->back();
    }
    public function destroy(User  $user, Request $request)
    {
        $follower = auth()->user();
   
        if ($user->id !== $follower->id) {
            $user->followers()->detach($follower->id);
        }

        return redirect()->back();
    }
}
