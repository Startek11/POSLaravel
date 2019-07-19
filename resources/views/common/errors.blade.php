@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger alert-dismissible fade show shadow p-1 bg-white rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
