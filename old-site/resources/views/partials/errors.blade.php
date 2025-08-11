@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <p>
            @foreach ($errors->all() as $error)
                <strong>{{ $error }}</strong><br>
            @endforeach
        </p>
    </div>
@endif
