@extends('home')
@section('crud-content')
    <x-alert-success />

    <x-alert-error />
    <x-card title="Categories">

        <table id="categoryTable" class="table">
            <thead>
                <tr>
                    <th>Category name</th>
                    <th>Category description</th>
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
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'csv'
                ]
            });
        </script>
    @endsection
