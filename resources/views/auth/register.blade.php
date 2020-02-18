@extends('layouts.inapp')

@section('content')
<section id="cover">
    <div class="cover-background">
      <img src="https://wallpaperaccess.com/full/1306229.jpg" />
    </div>
    <div class="cover-content">
        <h1>Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row form-login">
                <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Name') }}</label>

                <div class="col-md-12">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row form-login">
                <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row form-login">
                <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row form-login">
                <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row form-login">
                <div class="col-md-12">
                    <button type="submit" class="button-login">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
