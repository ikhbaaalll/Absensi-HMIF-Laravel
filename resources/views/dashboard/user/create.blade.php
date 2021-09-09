@extends('master.dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" required autofocus
                    placeholder="Masukkan nama">
            </div>
            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" required placeholder="Masukkan e-mail">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" value="{{ old('password') }}"
                    class="form-control @error('password') is-invalid @enderror" required
                    placeholder="Masukkan password">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                    class="form-control @error('password_confirmation') is-invalid @enderror" required
                    placeholder="Masukkan konfirmasi password">
            </div>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\UserStoreRequest') !!}
@endsection