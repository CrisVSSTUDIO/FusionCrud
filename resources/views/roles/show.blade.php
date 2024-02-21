@extends('home')
@section('crud-content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <x-card title="Show role">

            <div class="mb-3 row">
                <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Role name:</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $role->name }}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Permissions:</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    @if ($role->name=='Super Admin')
                    <span class="badge bg-primary">All permissions</span>
                    @else
                    @forelse ($rolePermissions as $permission)
                    <span class="badge bg-primary">{{ $permission->name }}</span>
                    @empty
                    @endforelse
                    @endif
                </div>
            </div>
        </x-card>

    </div>
</div>
@endsection