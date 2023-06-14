<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    function createFollow(User $user){
        if($user->id === auth()->user()->id){
            return back()->with("faliure", "you can not follow your self");
        }

        $alreadyExit = Follow::where([['user_id', '=', auth()->user()->id],['followeduser', '=', $user->id]])->count();

        if($alreadyExit){
            return back()->with("faliure", "you already follow ".$user->username);
        }

        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();
        return back()->with("success", "you are now following ".$user->username);
    }

    function removeFollow(User $user){
        $alreadyExit = Follow::where([['user_id', '=', auth()->user()->id],['followeduser', '=', $user->id]])->delete();
        return back()->with("success", "you have unfollowed ".$user->username);
    }
}
