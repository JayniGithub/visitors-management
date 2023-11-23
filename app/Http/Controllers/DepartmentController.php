<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('department.department-index');
    }

    public function fetchAll(Request $request) 
    {
        if ($request->ajax()) {
            $data = Department::all();

            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('action', function($row){
                                    return '<a href="/department/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>
                                    &nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
                                })
                                ->rawColumns(['action'])
                                ->make(true);
        }
    }

    public function addDepartmentView()
    {
        return view('department.department-add');
    }

    public function adddepartment(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
            'contact_person' => 'required'
        ]);

        $data = $request->all();

        Department::create([
            'department_name' => $data['department_name'],
            'contact_person' => $data['contact_person']
        ]);

        return redirect('/department/view')->with('success', 'Department Added Successfully..!');
    }

    public function edit($id)
    {
        $data = Department::findOrFail($id);

        return view('department.department-edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
            'contact_person' => 'required'
        ]);

        $data = $request->all();

        $formData = array(
            'department_name' => $data['department_name'],
            'contact_person' => $data['contact_person']
        );

        Department::whereId($data['hidden-id'])->update($formData);

        return redirect('/department')->with('success', 'Department Data Updated Successfully..!');
    }

    public function delete($id)
    {
        $data = Department::findOrFail($id);

        $data->delete();

        return redirect('/department')->with('success', 'Department Deleted Successfully..!');
    }
}
