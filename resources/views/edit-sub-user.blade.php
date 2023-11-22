@extends('dashboard')
@section('content')

    <h2 class="mt-3">Add Sub User</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/sub-user">Sub Users</a></li>
            <li class="breadcrumb-item active"><a href="/profile">Edit Sub User</a></li>
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
                <div class="card-header">Edit Sub User</div>
                <div class="card-body">
                    <form action="{{ route('new-sub-user.update') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name"><b>User Name: </b></label>
                            <input type="text" name="name" id="name" class="form-control" 
                            placeholder="Name" value="{{ $data->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="name"><b>Email Address: </b></label>
                            <input type="email" name="email" id="email" class="form-control" 
                            placeholder="Email Address" value="{{ $data->email }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="name"><b>Password: </b></label>
                            <input type="password" name="password" id="password" class="form-control" 
                            placeholder="Password">
                        </div>

                        <div class="d-grid mx-auto">
                            <input type="hidden" name="hidden-id" value="{{ $data->id }}">
                            <button type="submit" class="btn btn-dark btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection