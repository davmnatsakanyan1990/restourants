@extends('super_admin.layouts.index')

@section('content')
    <div class="myForm">
        <div class="registrUser">
            <form name="form1" class="userForm">
                <div class="title">Register group admin</div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <input placeholder="Username"/>
                </div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                    <input placeholder="Password"/>
                </div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                    <input placeholder="Confirm Password"/>
                </div>
                <div class="inputGroup">
                    <div class="i">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <input placeholder="Email"/>
                </div>
                <div class="clearElement">
                    <button class="floatRight registerAdmin">Register</button>
                </div>
            </form>
        </div>
    </div>

@endsection