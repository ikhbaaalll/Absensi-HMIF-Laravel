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
        <form method="POST" action="{{ route('calonanggota.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="form-control @error('nama') is-invalid @enderror" required autofocus
                    placeholder="Masukkan nama">
            </div>
            <div class="form-group">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" value="{{ old('nim') }}"
                    class="form-control @error('nim') is-invalid @enderror" required placeholder="Masukkan NIM">
            </div>
            <div class="form-group">
                <label class="form-label">Program Studi</label>
                <input type="text" name="prodi" value="{{ old('prodi') }}"
                    class="form-control @error('prodi') is-invalid @enderror" required
                    placeholder="Masukkan program studi">
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

{!! JsValidator::formRequest('App\Http\Requests\CalonAnggotaStoreRequest') !!}
@endsection