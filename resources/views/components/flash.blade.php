@if ($flash = session('message'))
    <div class="alert alert-success" role="alert">
        Selamat berhasil
    </div>
@endif

@if ($flash = session('error'))
    <div class="alert alert-danger" role="alert">
        Opps, ada yang error nicc
    </div>
@endif
