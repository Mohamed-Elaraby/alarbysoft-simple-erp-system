@extends('layouts.auth')

@section('content')

    <div class="register-logo">
        <a href="{{ url('/') }}"><b>A</b>laraby<b>S</b>oft</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif

                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="nickName" type="text" class="form-control{{ $errors->has('nickName') ? ' is-invalid' : '' }}" name="nickName" placeholder="nickName" value="{{ old('nickName') }}" required autofocus>

                @if ($errors->has('nickName'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nickName') }}</strong>
                    </span>
                @endif

                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="birthDate" type="text" class="form-control" name="birthDate"  data-date-format='yyyy-mm-dd'>
{{--                <input id="birthDate" type="text" class="form-control{{ $errors->has('birthDate') ? ' is-invalid' : '' }}" name="birthDate" value="{{ old('birthDate') }}" required autofocus data-date-format='yyyy-mm-dd'>--}}

                @if ($errors->has('birthDate'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                @endif

                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" name="salary" placeholder="Salary" value="{{ old('salary') }}" autofocus>

                @if ($errors->has('salary'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                @endif

                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" placeholder="Address" value="{{ old('address') }}" autofocus>

                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                @endif

                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                Google+</a>
        </div>

        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->

@push('scripts')
    <script>
        $("#birthDate").datepicker().datepicker("setDate", new Date());
    </script>
@endpush
@endsection
