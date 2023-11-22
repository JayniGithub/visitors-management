@extends('dashboard')
@section('content')

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header text-center">Login User</div>
                        <div class="card-body">
                            <form action="{{ route('login.custom') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Log In</button>
                                </div>
                            </form>
                            <br>
                            <div class="text-center">
                                <a href="{{ route('registration') }}" class="text-dark">Register User</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
@endsection