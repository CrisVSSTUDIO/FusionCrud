@props(['title', 'icon'=>null, 'toolbar' => null])

<!-- <div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon"><i class="{{!! $icon !!}}"></i></span>
            <h3 class="card-label">{{ $title }}</h3>
        </div>
        @if ($toolbar)
        <div class="card-toolbar">{!! $toolbar !!}</div>
        @endif
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div> -->

<div class="card m-2 shadow border-0">
    <h5 class="card-header text-center">{{ $title }}</h5>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>