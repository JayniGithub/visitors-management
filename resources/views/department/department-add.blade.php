@extends('dashboard')
@section('content')
    
<h2 class="mt-3">Add New Department</h2>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/department">Department</a></li>
        <li class="breadcrumb-item active"><a href="/department/view">Add Department</a></li>
    </ol>
</nav>

<div class="row mt-4">
    <div class="col-md-4">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">Add New Department</div>
            <div class="card-body">
                <form action="{{ route('department.add') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name"><b>Department Name: </b></label>
                        <input type="text" name="department_name" id="department_name" class="form-control" 
                        placeholder="Department Name">
                        @if ($errors->has('department_name'))
                            <span class="text-danger">{{ $errors->first('department_name') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="name"><b>Contact Person: </b></label>
                        <input type="text" name="contact_person" id="contact_person" class="form-control" 
                        placeholder="Contact Person">
                        @if ($errors->has('contact_person'))
                            <span class="text-danger">{{ $errors->first('contact_person') }}</span>
                        @endif
                    </div>

                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection