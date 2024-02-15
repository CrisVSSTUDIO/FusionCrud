@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="div-200">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
@endif
<script>
    setTimeout(function() {
        document.getElementById("div-200").style.display = "none";
    }, 6000)
</script>