<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\EditProfileInformationRequest;
use App\Http\Requests\EditProfileImageRequest;
use App\User;
use Illuminate\Http\Request;

class CommonPagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function edit_profile_image_form() {
        return view('common_pages.edit_profile_image');
    }

    public function update_profile_image(EditProfileImageRequest $request) {
        $user = User::find(auth()->user()->id);
        $imagePath = $request->profile_image->path();
        $imageFileName = $request->profile_image->getClientOriginalName();
        $imageNewName = $user->id . '_' . $imageFileName;
        move_uploaded_file($imagePath, 'uploads/users_images/' . $imageFileName);
        rename('uploads/users_images/' . $imageFileName, 'uploads/users_images/' . $imageNewName);
        if(!empty($user->image)) {
            unlink('images/users_images/' . $user->image);
        }
        copy('uploads/users_images/' . $imageNewName, 'images/users_images/' . $imageNewName);
        unlink('uploads/users_images/' . $imageNewName);

        auth()->logout();
        $user->update([
            'image' => $imageNewName
        ]);
        auth()->loginUsingId($user->id);

        return redirect()->route('redirect.to.dashboard');
    }

    public function delete_profile_image() {
        $user = User::find(auth()->user()->id);
        unlink('images/users_images/' . $user->image);
        $user->update([
            'image' => null
        ]);

        auth()->logout();
        auth()->loginUsingId($user->id);
        return redirect()->route('redirect.to.dashboard');
    }

    public function edit_profile_information() {
        return view('common_pages.edit_profile_information');
    }

    public function update_profile_information(EditProfileInformationRequest $request) {
        $user = User::find(auth()->user()->id);
        dd(bcrypt($request->password), $user->password);
        if($request->name == $user->name && $request->email == $user->email && $request->password == $user->password) {
            dd('salam');
            return redirect()->route('redirect.to.dashboard');
        }
        dd('hello');
        if($request->name != $user->name && $request->email == $user->email && $request->passowrd == $user->password) {
            $user->update([
                'name' => $request->name
            ]);

            auth()->logout();
            auth()->loginUsingId($user->id);
            return redirect()->route('redirect.to.dashboard');
        }

        $user_exists = User::where('email', $request->email)->orWhere('password', $request->password)->exists();
        if($user_exists) {
            abort(500);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
        }

        auth()->logout();
        auth()->loginUsingId($user->id);
        return redirect()->route('redirect.to.dashboard');
    }

    public function show_comments() {
        $comments = Comment::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        if(auth()->user()->type == 'admin') {
            return view('common_pages.show_comments_for_admin', ['comments' => $comments]);
        } else {
            return view('common_pages.show_comments_for_user', ['comments' => $comments]);
        }
    }

    public function delete_comment(Comment $comment) {
        $comment->delete();
        return redirect()->route('show.comments');
    }
}
