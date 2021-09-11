@extends('master.dashboard')

@section('title-page')
    Edit {{ $calonanggotum->nama }}
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
            <form method="POST" action="{{ route('calonanggota.update', ['calonanggotum' => $calonanggotum]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" value="{{ $calonanggotum->nama }}"
                        class="form-control @error('nama') is-invalid @enderror" required autofocus
                        placeholder="Masukkan nama">
                </div>
                <div class="form-group">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" value="{{ $calonanggotum->nim }}"
                        class="form-control @error('nim') is-invalid @enderror" required placeholder="Masukkan NIM">
                </div>
                <div class="form-group">
                    <label class="form-label" for="kelompok">Kelompok</label>
                    <select name="kelompok" id="kelompok" class="form-control @error('kelompok') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Kelompok</option>
                        <option value="1" {{ $calonanggotum->kelompok == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $calonanggotum->kelompok == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $calonanggotum->kelompok == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $calonanggotum->kelompok == 4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $calonanggotum->kelompok == 5 ? 'selected' : '' }}>5</option>
                        <option value="6" {{ $calonanggotum->kelompok == 6 ? 'selected' : '' }}>6</option>
                        <option value="7" {{ $calonanggotum->kelompok == 7 ? 'selected' : '' }}>7</option>
                        <option value="8" {{ $calonanggotum->kelompok == 8 ? 'selected' : '' }}>8</option>
                        <option value="9" {{ $calonanggotum->kelompok == 9 ? 'selected' : '' }}>9</option>
                        <option value="10" {{ $calonanggotum->kelompok == 10 ? 'selected' : '' }}>10</option>
                        <option value="11" {{ $calonanggotum->kelompok == 11 ? 'selected' : '' }}>11</option>
                        <option value="12" {{ $calonanggotum->kelompok == 12 ? 'selected' : '' }}>12</option>
                        <option value="13" {{ $calonanggotum->kelompok == 13 ? 'selected' : '' }}>13</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
@endsection
