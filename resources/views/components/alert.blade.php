@if(session('success'))
<div id="toast" class="position-fixed top-0 end-0 p-3">
    <div class="toast show bg-success text-white">
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
</div>

<script>
setTimeout(() => {
    document.getElementById('toast')?.remove();
}, 3000);
</script>
@endif