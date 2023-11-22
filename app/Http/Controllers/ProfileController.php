<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // when creating object using this class this construct method calls automatically.
    // Then users directly redirect to login page without log in to system

    public function index() {
        $data = User::findOrFail(Auth::user()->id);
        return view('profile', compact('data'));
    }

    function edit(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->all();

        if (!empty($data['password'])) {
            $formData = array(
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            );
        } else {
            $formData = array(
                'name' => $data['name'],
                'email' => $data['email']
            );
        }

        User::whereId(Auth::user()->id)->update($formData);

        return redirect('profile')->with('success', 'User Data Updated Successfully..!');
        
    }
}
