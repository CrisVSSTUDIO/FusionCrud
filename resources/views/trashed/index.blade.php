@extends('home')
@section('crud-content')
<x-card title="Manage products">

    <!-- Modal restaurar-->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="restoreLabel"> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('restoreasset', 'id') }}" enctype="multipart/form-data" id="restore">

                    <div class="modal-body" id="restoreText">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary" id="restoreBtn">Criar Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal eliminar-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="removeLabel">Remover </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="removeText">
                    Tem a certeza que pretende remover o permanentemente? </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Remover</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Pills navs -->
    <ul class="nav nav-pills " id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-asset-tab" data-bs-toggle="pill" data-bs-target="#pills-asset" type="button" role="tab" aria-controls="pills-asset" aria-selected="true">Assets</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-categories-tab" data-bs-toggle="pill" data-bs-target="#pills-categories" type="button" role="tab" aria-controls="pills-categories" aria-selected="false">Categories</button>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-asset" role="tabpanel" aria-labelledby="pills-asset-tab" tabindex="0">
            <div class="table-responsive">

                <table class="table p-2" id="assetTable">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Criado em</th>
                            <th scope="col">Editado em</th>
                            <th scope="col">Eliminado em</th>
                            <th scope="col">Acções
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productsCrapped as $deletedAsset)

                        <tr>
                            <td>{{$deletedAsset->name}}</td>
                            <td>{{$deletedAsset->description}}</td>
                            <td>{{$deletedAsset->created_at}}</td>
                            <td>{{$deletedAsset->updated_at}}</td>
                            <td>{{$deletedAsset->deleted_at}}</td>
                            <td><a class="btn btn-primary btn-sm m-2 " href="#" role="button" data-bs-toggle="modal" data-bs-target="#restoreModal" data-bs-name="{{$deletedAsset->name}}" data-bs-id="{{$deletedAsset->id}}" data-bs-whoami="Asset">Restaurar</a>
                                <a class="btn btn-danger btn-sm m-2 " href="#" role="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-name="{{$deletedAsset->name}}" data-bs-id="{{$deletedAsset->id}}" data-bs-whoami="Asset">Eliminar permanentemente</a>

                            </td>


                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="tab-pane fade" id="pills-categories" role="tabpanel" aria-labelledby="pills-categories-tab" tabindex="0">
            <div class="table-responsive">

                <table class="table p-2" id="categoryTable">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Criado em</th>
                            <th scope="col">Editado em</th>
                            <th scope="col">Eliminado em</th>
                            <th scope="col">Acções
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoriesCrapped as $deletedCategory)

                        <tr>
                            <td>{{$deletedCategory->category_name}}</td>
                            <td>{{$deletedCategory->category_description}}</td>
                            <td>{{$deletedCategory->created_at}}</td>
                            <td>{{$deletedCategory->updated_at}}</td>
                            <td>{{$deletedCategory->deleted_at}}</td>
                            <td><a class="btn btn-primary btn-sm m-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#restoreModal" data-bs-name="{{$deletedCategory->category_name}}" data-bs-id="{{$deletedCategory->id}}" data-bs-whoami="Categoria">Restaurar</a>
                                <a class="btn btn-danger btn-sm m-2 " href="#" role="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-name="{{$deletedCategory->category_name}}" data-bs-id="{{$deletedCategory->id}}" data-bs-whoami="Categoria">Eliminar permanentemente</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-card>


<script type="module">
    const exampleModal = document.getElementById('restoreModal')
    const deleteModal = document.getElementById('deleteModal')
    if (restoreModal) {
        restoreModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const obejectName = button.getAttribute('data-bs-name')
            const contentId = button.getAttribute('data-bs-id')
            let whoami = button.getAttribute('data-bs-whoami')
            console.log(whoami)
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            // Update the modal's content.
            const modalTitle = restoreModal.querySelector('.modal-title')
            const modalBody = restoreModal.querySelector('.modal-body ')
            modalTitle.textContent = `  Restaurar ${obejectName}`
            modalBody.textContent = ` Deseja mesmo restaurar  ${obejectName}?`
            if (whoami = "Asset") {
                var url = "{{ route('restoreasset', ':id') }}"

            } else {
                var url = "{{ route('restorecat', ':id') }}"

            }
            url = url.replace(':id', contentId);
            var restoreBtn = document.getElementById('restore');
            restoreBtn.setAttribute("url", url)
        })
    }
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const obejectName = button.getAttribute('data-bs-name')
            const contentId = button.getAttribute('data-bs-id')

            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.
            let whoami = button.getAttribute('data-bs-whoami')
            console.log(whoami)
            if (whoami = "Asset") {
                var url = "{{ route('deleteasset', ':id') }}"

            } else {
                var url = "{{ route('deletecat', ':id') }}"

            }
            // Update the modal's content.
            const modalTitle = deleteModal.querySelector('.modal-title')
            const modalBody = deleteModal.querySelector('.modal-body ')
            modalTitle.textContent = `  Remover ${obejectName}`
            modalBody.textContent = ` Deseja mesmo remover ${obejectName}?`
            var url = "{{ route('deleteasset', ':id') }}"
            url = url.replace(':id', contentId);
            var restoreBtn = document.getElementById('restoreBtn');
            restoreBtn.setAttribute("action", url)
        })
    }
    //var potato = document.getElementsByClassName('tab-pane fade active show')[0].id


    $('#assetTable').DataTable({
responsive:true,
    });
    $('#categoryTable').DataTable({
        responsive:true,

    });
</script>
@endsection