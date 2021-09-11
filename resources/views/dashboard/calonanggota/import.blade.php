@extends('master.dashboard')

@section('title-page')
    Import Data
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
            <form method="POST" action="{{ route('calonanggota.importStore') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">File</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required
                        placeholder="Masukkan file" accept=".xlsx">
                </div>
                <div class="form-group">
                    <label class="form-label">Kelompok</label>
                    <input type="number" name="kelompok" class="form-control @error('kelompok') is-invalid @enderror"
                        required placeholder="Masukkan kelompok">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        required placeholder="Masukkan password">
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
@endsection
