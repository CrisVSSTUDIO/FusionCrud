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
                'copy', 'excel', 'pdf', 'csv'
            ]
        });
    </script>
@endsection
