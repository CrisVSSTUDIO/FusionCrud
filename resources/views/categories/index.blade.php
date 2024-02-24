@extends('home')
@section('crud-content')


    <x-card title="Categories">

        <table id="categoryTable" class="table">
            <thead>
                <tr>
                    <th>Category name</th>
                    <th>Category description</th>
                    <th>Slug</th>
                    <th>Actions</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>

                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_description }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <form action="{{ route('categories.destroy', $category) }}" method="post">
                                @csrf
                                @method('DELETE')
        
                                @can('edit-category')
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                @endcan
        
                                @can('delete-category')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');"><i class="bi bi-trash"></i> Delete</button>
                                @endcan
                                
        
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </x-card>
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
