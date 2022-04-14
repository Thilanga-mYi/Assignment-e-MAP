@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5%">
    <div class="row justify-content-center">
        <div class="col-md-4 col-xs-3 col-xl-3">

            <div class="mb-4 text-center">
               
            </div>

            <div class="card border-0 m-3 m-sm-0 m-md-0">

                <div class="card-header p-4 text-center" style="background-color: #212121">
                    <h5 class="header_new_text text-white">
                        {{ __('Login') }}
                    </h5>
                    <h6 class="header_new_text text-white">
                        {{ env('APP_NAME','') }}
                    </h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mt-3">

                            <div class="col-md-12">
                                <label for="email" class="text-md-right mb-2">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mt-2">
                            <div class="col-md-12">
                                <label for="email" class="text-md-right mb-2">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn w-100 text-white" style="background-color: #212121">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
