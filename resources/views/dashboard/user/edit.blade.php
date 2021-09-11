@extends('master.dashboard')

@section('title-page')
    Edit {{ $user->name }}
@endsection

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
            <form method="POST" action="{{ route('user.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class="form-control @error('name') is-invalid @enderror" required autofocus
                        placeholder="Masukkan nama">
                </div>
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                        class="form-control @error('email') is-invalid @enderror" required placeholder="Masukkan e-mail">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" value=""
                        class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password_confirmation" value=""
                        class="form-control @error('password_confirmation') is-invalid @enderror"
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
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\UserUpdateRequest') !!}
@endsection
