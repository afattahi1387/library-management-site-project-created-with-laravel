<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\EditProfileImageRequest;

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
}
