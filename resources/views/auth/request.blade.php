@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <x-card title="Invitation request">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif


                    <p>{{ config('app.name') }} is a closed community. You must have an invitation link to register. You
                        can request your link below.</p>

                    <form  method="POST" action="{{ route('unlock') }}">
                        {{ csrf_field() }}

                        <div class="form-group mb-3 p-2{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-3 p-2">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Request An Invitation
                                </button>

                                <a class="btn btn-link" href="{{ route('login') }}">
                                    Already Have An Account?
                                </a>
                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    @endsection
