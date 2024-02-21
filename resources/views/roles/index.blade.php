@extends('home')
@section('crud-content')
<x-card title="Manage all roles">
    @can('create-role')
    <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> New role</a>
    @endcan
    <table class="table table-striped table-bordered " id="roleTable">
        <thead>
            <tr>
                <th scope="col">Role name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>See role</a>
                        @if ($role->name!='Super Admin')
                        @can('edit-role')
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                        @endcan

                        @can('delete-role')
                        @if ($role->name!=Auth::user()->hasRole($role->name))
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?');"><i class="bi bi-trash"></i> Delete</button>
                        @endif
                        @endcan
                        @endif

                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</x-card>

<script type="module">
    $('#roleTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'csv', 'print'
        ]
    });
</script>
@endsection