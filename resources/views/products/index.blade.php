@extends('home')
@section('crud-content')

    <x-card title="Manage products">

            <table id="productsTable" class="table">
                <thead>
                    <tr>
                        <th>Asset name</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Belongs to category</th>
                        <th>Actions</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>

                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->category_name }}</td>

                            <td>
                                <form action="{{ route('products.destroy', $product) }}" method="post">
                                    @csrf
                                    @method('DELETE')
            
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>See product</a>
                                    @can('edit-product')
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @endcan
            
                                    @can('delete-product')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                    @endcan
                                    
            
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
    </x-card>

    <script type="module">
        $('#productsTable').DataTable({
            responsive:true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'pdf', 'csv'
            ]
        });
    </script>
@endsection
