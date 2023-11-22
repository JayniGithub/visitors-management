<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SubUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sub-user');
    }

    public function fetchAll(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('type', '=', 'User')->get();

            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="/sub-user/edit/'.$row->id.'" class="btn btn-primary btn-sm">
                                Edit</a>
                                &nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function subUser()
    {
        return view('add-sub-user');
    }

    public function addNewUser(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|unique:users|email',
            'password'  => 'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name'  => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'User'
        ]);

        return redirect('sub-user-add')->with('success', 'New User Added Successfully');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('edit-sub-user', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->all();

        if (!empty($data['password'])) {
            $formData = array(
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            );
        } else {
            $formData = array(
                'name' => $data['name'],
                'email' => $data['email']
            );
        }

        User::whereId($data['hidden-id'])->update($formData);

        return redirect('sub-user')->with('success', 'Sub User Data Updated Successfully..!');
        
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect('sub-user')->with('success', 'The user deleted successfully..!');
    }
}
