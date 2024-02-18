@extends('home')
@section('crud-content')
<x-alert-success />

<x-alert-error />
<table id="categoryTable" class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Slug</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>

            <td>{{ $category->category_name }}</td>
            <td>{{ $category->categpry_description }}</td>
            <td>{{ $category->slug }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script type="module">
    $('#categoryTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'csv'
        ]
    });
</script>
@endsection



