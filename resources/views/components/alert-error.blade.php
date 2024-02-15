@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="div-400">
    <ul>
        @foreach ($errors as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    {{ $errors }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
@endif
<script>
    setTimeout(function() {
        document.getElementById("div-400").style.display = "none";
    }, 10000)
</script>