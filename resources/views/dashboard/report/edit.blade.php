@extends('master.dashboard')

@section('title-page')
    Edit {{ $kegiatan->judul }}
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
            <form method="POST" action="{{ route('kegiatan.update', $kegiatan) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="kegiatan" id="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror">
                        <option value="Materi" {{ $kegiatan->kegiatan == 'Materi' ? 'selected' : '' }}>Materi</option>
                        <option value="Evaluasi" {{ $kegiatan->kegiatan == 'Evaluasi' ? 'selected' : '' }}>Evaluasi
                        </option>
                        <option value="Minggu Ceria" {{ $kegiatan->kegiatan == 'Minggu Ceria' ? 'selected' : '' }}>Minggu
                            Ceria</option>
                        <option value="Lainnya" {{ $kegiatan->kegiatan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" value="{{ $kegiatan->judul }}"
                        class="form-control @error('judul') is-invalid @enderror" required autofocus
                        placeholder="Masukkan judul">
                </div>
                <div class="form-group">
                    <label class="form-label">Tempat</label>
                    <input type="text" name="tempat" value="{{ $kegiatan->tempat }}"
                        class="form-control @error('tempat') is-invalid @enderror" required autofocus
                        placeholder="Masukkan tempat">
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu</label>
                    <input type="datetime-local" name="waktu" value="{{ $kegiatan->waktu->format('Y-m-d\TH:i') }}"
                        class="form-control @error('waktu') is-invalid @enderror" required autofocus
                        placeholder="Masukkan waktu">
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
@endsection
