@extends('master.dashboard')

@section('title-page')
    Daftar Kegiatan
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/table/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Kegiatan</h6>
            </div>
            <div class="card-body">
                <div class="my-3">
                    <form method="GET" action="{{ route('kegiatan.index') }}">
                        <select name="kategori" class="form-control col-2 d-inline-block">
                            <option value="">Pilih Kategori</option>
                            @forelse ($kategoris as $kategori)
                                <option value="{{ $kategori->kegiatan }}"
                                    {{ $kategori->kegiatan == request()->get('kategori') ? 'selected' : '' }}>
                                    {{ $kategori->kegiatan }}
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada kategori</option>
                            @endforelse
                        </select>
                        <select name="tempat" class="form-control col-2 d-inline-block">
                            <option value="">Pilih Tempat</option>
                            @forelse ($tempats as $tempat)
                                <option value="{{ $tempat->tempat }}"
                                    {{ $tempat->tempat == request()->get('tempat') ? 'selected' : '' }}>
                                    {{ $tempat->tempat }}</option>
                            @empty
                                <option value="" disabled>Tidak ada tempat</option>
                            @endforelse
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tempat</th>
                                <th>Kegiatan</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kegiatans as $kegiatan)
                                <tr>
                                    <td>{{ $kegiatan->judul }}</td>
                                    <td>{{ $kegiatan->tempat }}</td>
                                    <td>{{ $kegiatan->kegiatan }}</td>
                                    <td>{{ $kegiatan->waktu->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('kegiatan.show', $kegiatan) }}"
                                            class="btn btn-sm btn-primary">Presensi</a>
                                        <a href="{{ route('kegiatan.edit', $kegiatan) }}"
                                            class="btn btn-sm btn-warning">Ubah</a>
                                    </td>
                                </tr>
                            @empty($kegiatans)
                                <tr>
                                    <td colspan="4">Tidak ada data kegiatan</td>
                                </tr>
                            @endempty
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/table/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/table/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/table/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/table/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/table/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/table/jszip.min.js') }}"></script>
<script src="{{ asset('js/table/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/table/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/table/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/table/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/table/buttons.colVis.min.js') }}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5', "colvis"
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
