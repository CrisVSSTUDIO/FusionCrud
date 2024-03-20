@extends('layouts.app')

@section('content')
    <!-- Section: Design Block -->
    <section>
        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="px-3 py-4 p-md-5 ">
                            <p class="fs-1 " style="color:#0369a1">Register a free account</p>
                            <p class="fs-6">You must have an account in order to access the main features of this
                                application!</p>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card-body p-md-4 p-sm-4 mx-md-4 shadow border-0">
                            <div class="text-center">
                                <img src="{{ asset('assets\icon\logo_icon_tab.png') }}" style="width: 185px;"
                                    alt="logo">

                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row p-sm-4">
                                    <div class="form-outline mb-4">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>


                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>


                                        <input type="email" class="form-control disabled" value="{{ $email }}"
                                            disabled>
                                        <input id="email" type="hidden" class="form-control disabled" name="email"
                                            value="{{ $email }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>


                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="password-confirm"
                                            class="form-label">{{ __('Confirm Password') }}</label>


                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">

                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
@endsection
