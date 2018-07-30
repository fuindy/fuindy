@extends('layouts.main_login')
@section('content')
    <!-- START PAGE-CONTAINER -->
    <div class="login-wrapper ">
        <!-- START Login Background Pic Wrapper-->
        <div class="bg-pic">
            <!-- START Background Pic-->
            <img src="{{asset('scaffolding/core/img/discussion.jpg')}}"
                 data-src="{{asset('scaffolding/core/img/discussion.jpg')}}"
                 data-src-retina="{{asset('scaffolding/core/img/discussion.jpg')}}" alt="" class="lazy">
            <!-- END Background Pic-->
            <!-- START Background Caption-->
            <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
                <h2 class="semi-bold text-white">
                    Committed to Better Quaility</h2>
                <p class="small">
                    Images Displayed are solely for representation purposes only, All work copyright of respective
                    owner, otherwise © 2017 GlobalXtreme.
                </p>
            </div>
            <!-- END Background Caption-->
        </div>
        <!-- END Login Background Pic Wrapper-->

        <!-- START Login Right Container-->
        <div class="login-container bg-white">
            <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
                <img src="{{asset('scaffolding/core/img/logo_app_crm.png')}}" alt="logo" data-src="{{asset('scaffolding/core/img/logo_app_crm.png')}}"
                     data-src-retina="{{asset('scaffolding/core/img/logo_app_crm.png')}}" width="140">
                <span class=" fs-14 ">v.{{config('version.name')}}</span>

                <p class="p-t-35">Sign into your pages account</p>
                {{--@include('layouts.partials.snippets._error_alert_1')--}}
            <!-- START Login Form -->
                <form id="form-login" class="p-t-15" role="form"  action="{{route('login')}}" method="POST">
                    {{--action="{{route('login')}}"--}}

                {{csrf_field()}}

                <!-- START Form Control-->
                    <div class="form-group form-group-default">
                        <label>Login</label>
                        <div class="controls">
                            <input type="text" name="email" placeholder="Email" class="form-control" required
                                   value="{{old('email')}}">
                        </div>
                    </div>
                    <!-- END Form Control-->
                    <!-- START Form Control-->
                    <div class="form-group form-group-default">
                        <label>Password</label>
                        <div class="controls">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <!-- START Form Control-->
                    <div class="row">
                        <div class="col-md-6 no-padding sm-p-l-10">
                            <div class="checkbox ">
                                <input type="checkbox" value="1" id="checkbox1">
                                <label for="checkbox1">Keep Me Signed in</label>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                            <a href="{{url('/password/reset')}}" class="text-info small">Forgot Password?</a>
                        </div>
                    </div>
                    <!-- END Form Control-->
                    <button class="btn btn-info btn-cons m-t-10" type="submit">Sign in</button>
                </form>
                <!--END Login Form-->

                <div class="m-b-20" style="bottom: 0;position: absolute;">
                    <h4>System Requirement</h4>
                    <img src="{{asset('scaffolding/core/img/supported-browser.png')}}" alt="chrome" height="48">
                    <p class="m-t-10">Currently supported browser : <span class="bold">Chrome</span> </p>
                </div>
            </div>



        </div>
        <!-- END Login Right Container-->




    </div>
    <!-- END PAGE CONTAINER -->

@endsection