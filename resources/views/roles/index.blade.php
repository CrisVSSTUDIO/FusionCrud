@extends('home')
@section('crud-content')
<div class="card">
    <div class="card-header">Gerir funções</div>
    <div class="card-body">
        @can('create-role')
        <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Nova função</a>
        @endcan
        <table class="table table-striped table-bordered table responsive" id="rolesTable">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col" style="width: 250px;">Acao</th>
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

                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>Ver</a>

                            @if ($role->name!='Super Admin')
                            @can('edit-role')
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                            @endcan

                            @can('delete-role')
                            @if ($role->name!=Auth::user()->hasRole($role->name))
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem a certeza que pretende eliminar?');"><i class="bi bi-trash"></i> Remover</button>
                            @endif
                            @endcan
                            @endif

                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>


    </div>
</div>

<script type="module">
    $('#rolesTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'csv'
        ]
    });
</script>
@endsection