@extends('home')
@section('crud-content')
    <x-alert-success />

    <x-alert-error />
    <div class="card">
        <div class="card-header">Gerir Assets</div>
        <div class="card-body">
            <table id="productsTable" class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Slug</th>
                        <th>Categoria</th>

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
        </div>
    </div>

    </div>

    <script type="module">
        $('#productsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'csv'
            ]
        });
    </script>
@endsection
