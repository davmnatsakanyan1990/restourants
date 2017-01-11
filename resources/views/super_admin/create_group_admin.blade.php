@extends('super_admin.layouts.index')

@section('content')
    <div class="myForm">
        <div class="registrUser">
            <form name="form1" class="userForm" method="post" action="{{ url('super_admin/group_admin/save') }}">
                <div class="title">Register group admin</div>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <input name="name" value="{{ old('name') }}" placeholder="Name"/>
                </div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <input name="username" value="{{ old('username') }}" placeholder="Username"/>
                </div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                    <input name="password" type="password" placeholder="Password"/>
                </div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                    <input name="password_confirmation" type="password" placeholder="Confirm Password"/>
                </div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <input name="email" value="{{ old('email') }}" placeholder="Email"/>
                </div>
                <div class="clearElement">
                    <button type="submit" class="floatRight registerAdmin">Register</button>
                </div>
            </form>
        </div>
    </div>

@endsection