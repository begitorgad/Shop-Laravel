<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index(){
        return view('profile.index');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $user = $request->user();

        if ($user->image) {
            Storage::disk('public')->delete($user->image->path);
            $user->image()->delete();
        }

        $path = $request->file('image')->store('profiles', 'public');

        $user->image()->create([
            'path' => $path,
        ]);

        return back()->with('success', 'Profile image updated.');
    }
}
