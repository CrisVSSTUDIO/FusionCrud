@extends('jome')
@section('crud-content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <x-card title="User information">

            <div class="mb-3 row">
                <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Nome:</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $user->name }}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Email:</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $user->email }}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Funções:</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    @forelse ($user->getRoleNames() as $role)
                    <span class="badge bg-primary">{{ $role }}</span>
                    @empty
                    @endforelse
                </div>
            </div>
        </x-card>

    </div>
    @endsection