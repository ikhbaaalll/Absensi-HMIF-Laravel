@extends('master.dashboard')

@section('title-page')
    Tambah Calon Peserta
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
                    <label class="form-label" for="kelompok">Kelompok</label>
                    <select name="kelompok" id="kelompok" class="form-control @error('kelompok') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Kelompok</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
@endsection
