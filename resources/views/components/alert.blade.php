@if (Session::has('success'))
    <div class="alert alert-success" style="padding: 2rem;">
        {{ Session::get('success') }}
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger" style="padding: 2rem;">
        {{ Session::get('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger" style="padding: 2rem;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
