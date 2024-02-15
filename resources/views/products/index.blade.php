@extends('layouts.app')
@section('content')

<x-pricing view="products.index" />

@if (isset($assets))
<section class="products">

    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 shadow-lg bg-white border-0">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Index</a></li>
                        <li class="breadcrumb-item " aria-current="page">{{$category_slug ?? 'Uncategorized'}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <x-alert-success />

    <x-alert-error />


    <div class="main-container " id="main-container">

        @forelse ($assets as $asset)

        @php $filextension=pathinfo($asset->upload,PATHINFO_EXTENSION );
        @endphp


        <div class="card-body-mine shadow p-3 mb-5 bg-body rounded slide-in">
            @if($filextension)

            <div class="card-top text-center">
                @switch($filextension)
                @case($filextension == 'glb')
                <model-viewer alt="{{ $asset->name ?? 'Sem nome' }}" src="{{ asset('storage/' . $asset->upload ) }}" ar camera-controls touch-action="pan-y" loading="lazy" class="w-100"></model-viewer>
                @break

                @case($filextension == 'zip' || $filextension == 'rar')
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-file-earmark-zip" viewBox="0 0 16 16">
                    <path d="M5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.11 0l-.929-.62a1 1 0 0 1-.415-1.074L5 8.438V7.5zm2 0H6v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.929-.62-.4-1.598A1 1 0 0 1 7 8.438V7.5z" />
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1h-2v1h-1v1h1v1h-1v1h1v1H6V5H5V4h1V3H5V2h1V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                </svg>
                @break

                @case($filextension == 'pdf' || $filextension == 'webm')
                <iframe src="{{ asset('storage/' . $asset->upload) }}" title="{{ $asset->name ?? 'Sem nome' }}" class="text-center w-100 h-100"></iframe>
                @break

                @case($filextension == 'csv')
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-filetype-csv" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.517 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495Zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879l-1.327 4Z" />
                </svg>
                @break

                @default
                <img src="{{ asset('storage/' . $asset->upload) }}" alt="{{ $asset->name ?? 'Sem nome' }}" class="mycard-img-top" loading="lazy" />
                @endswitch
            </div>
            @endif
            <hr>
            <div class="card-body-info">

                <h3 class="card-title mt-2">{{ $asset->name ?? 'Sem nome' }}</h3>
                <span class="card-description mt-2">
                    {{ Str::words($asset->description ?? 'Sem descrição', 12, '...') }}
                </span>

                <div class="button-area">
                    <a class="btn btn-primary  rounded-pill px-3  mt-2" href="{{route('products.show',$asset)}}" role="button">Visualizar
                        {{ $asset->name ?? 'Asset' }}</a>
                </div>
            </div>
        </div>

        @empty
        <x-nodata />

        @endforelse
    </div>

    <div class="container d-flex justify-content-center">{{ $assets->links() }}</div>

    </div>




</section>
@elseif(isset($productsearch))
<section class="products-search">


    @if (count($productsearch) > 0)
    <div class="alert text-center" role="alert" id="alert_info">
        <b> Temos <u class="text-info"><?php echo htmlspecialchars($rowcount ?? ''); ?></u>
            {{ $rowcount > 1 ? 'assets' : 'asset' }}</b>
    </div>
    <x-alert-success />

    <x-alert-error />


    <div class="main-container " id="main-container">

        @forelse ($productsearch as $product)
        @php $filextension=pathinfo($product->upload,PATHINFO_EXTENSION ); @endphp


        <div class="card-body-mine shadow p-3 mb-5 bg-body rounded slide-in">
            @if($filextension)
            <div class="card-top text-center">
                @switch($filextension)
                @case($filextension == 'glb')
                <model-viewer alt="{{ $product->name ?? 'Sem nome' }}" src="{{ asset('storage/' . $product->upload) }}" ar camera-controls touch-action="pan-y" loading="lazy" class="w-100"></model-viewer>
                @break

                @case($filextension == 'zip' || $filextension == 'rar')
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-file-earmark-zip" viewBox="0 0 16 16">
                    <path d="M5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.11 0l-.929-.62a1 1 0 0 1-.415-1.074L5 8.438V7.5zm2 0H6v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.929-.62-.4-1.598A1 1 0 0 1 7 8.438V7.5z" />
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1h-2v1h-1v1h1v1h-1v1h1v1H6V5H5V4h1V3H5V2h1V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                </svg>
                @break

                @case($filextension == 'pdf')
                <iframe src="{{ asset('storage/' . $product->upload) }}" title="{{ $product->name ?? 'Sem nome' }}" class="text-center w-100 h-100"></iframe>
                @break

                @case($filextension == 'csv')
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-filetype-csv" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.517 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495Zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879l-1.327 4Z" />
                </svg>
                @break

                @default
                <img src="{{ asset('storage/' . $product->upload) }}" alt="{{ $product->name ?? 'Sem nome' }}" class="mycard-img-top" loading="lazy" />
                @endswitch
            </div>
            @endif
            <hr>
            <div class="card-body-info">
                <h3 class="card-title mt-2">{{ $product->name ?? 'Sem nome' }}</h3>
                <span class="card-description mt-2">{{ Str::words($product->description ?? 'Sem descrição', 12, '...') }}
                </span>
                <div class="button-area">
                    <a class="btn btn-primary  rounded-pill px-3  mt-2" href="{{ route('products.show', $product) }}" role="button">Visualizar
                        asset</a>
                </div>
            </div>
        </div>
        @empty
        <x-nodata />
        @endforelse
    </div>
</section>

@endif
</div>
@endif
<script>
    function downloadTest(id) {
        localStorage.setItem('name', id)
    }
</script>
@endsection