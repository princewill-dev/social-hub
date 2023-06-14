<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // public function home() {
    //     return view('index');
    // }

    public function register(Request $request) {
        $userdata = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'password' => ['required', 'confirmed'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['required', 'min:11'],
        ]);

        $userdata['password'] = bcrypt($userdata['password']);
        User::create($userdata);
        return redirect('/')->with('success', 'Regitration Success');
    }

    public function login(Request $request) {
        $userdata = $request -> validate([
            'userlogin' => 'required',
            'userpassword' => 'required'
        ]);

        if(auth()->attempt(['username' => $userdata['userlogin'], 'password' => $userdata['userpassword']])){
            $request->session()->regenerate();
            //return 'login successful';
            return redirect('/')->with('success', 'login successful');
        }else {
            //return 'login failed';
            return redirect('/')->with('faliure', 'username or password is incorrect');
        }

    }

    public function homeContent() {
        if(auth()->check()){
            return view('profile');
        }else {
            return view('index');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    private function getSharedData(User $user) {
        $currentlyFollowing = 0;
        if(auth()->check()){
            $currentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id],['followeduser', '=', $user->id]])->count();
        }
        view::share('sharedData',['currentlyFollowing'=> $currentlyFollowing, 'avatar'=>$user->avatar, 'username' => $user->username, 'postCount' => $user->posts()->count()]);
    }

    public function profile(User $user){
        $this->getSharedData($user);
        return View('profile-feeds', ['posts' => $user->posts()->latest()->get(),]);
    }

    function profileFollowers(User $user){
        $this->getSharedData($user);
        return view('profile-follower', ['followers' => $user->followers()->latest()->get(),]);
    }

    function profileFollowing(User $user){
        $this->getSharedData($user);
        return view('profile-following', ['following' => $user->followingTheseUsers()->latest()->get(),]);
    }

    public function uploadProfile() {
        return view('profile-upload');
    }

    public function saveImage(Request $request) {
        $request -> validate(['user-image' => 'required|image|max:3000']);
        // $request->file('user-image')->store('public/img');
        $user = auth()->user();
        $imgData = Image::make($request->file('user-image'))->fit(120)->encode('jpg');
        $filename = $user->id .'-'.uniqid() .'.jpg';
        Storage::put('public/img/'.$filename, $imgData);
        $oldavatar = $user->avatar;
        $user->avatar = $filename;
        $user->save();

        if($oldavatar != '/default.png'){
            Storage::delete(str_replace("/storage/", "public/", $oldavatar));
        }

        return back()->with('success', 'upload successfull');
    }




    // API functions


    function loginApi(Request $request) {
        $userdata = $request -> validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($userdata)) {
            $user = User::where('username', $userdata['username'])->first();
            $token = $user->createToken('ourapptoken')->plainTextToken;
            return $token;
        }
        return 'can not find user';
    }

    
}
