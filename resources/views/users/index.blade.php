@extends('home')
@section('crud-content')
<x-card title="Manage users">
    @can('create-user')
    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add a new user</a>
    @endcan
    <table class="table table-striped table-bordered" id="userTable">
        <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">User roles</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @forelse ($user->getRoleNames() as $role)
                    <span class="badge bg-primary">{{ $role }}</span>
                    @empty
                    @endforelse
                </td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show user</a>

                        @can('edit-user')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit user</a>
                        @endcan

                        @can('delete-user')
                        @if (Auth::user()->id!=$user->id)
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this user?');"><i class="bi bi-trash"></i> Delete user</button>
                        @endif
                        @endcan

                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</x-card>

<script type="module">
    $('#userTable').DataTable({
        responsive:true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'csv','print'
        ]
    });
</script>
@endsection