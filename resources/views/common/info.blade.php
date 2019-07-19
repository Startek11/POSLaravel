@if(session('info'))

    <div class="alert col-12 bg-white text-success border border-success rounded shadow alert-dismissible fade show" role="alert">
        <i class="fas fa-info-circle"></i> {{session('info')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
    </div>

@endif