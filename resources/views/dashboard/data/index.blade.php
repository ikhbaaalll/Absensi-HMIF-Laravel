@extends('master.dashboard')

@section('title-page')
    Presensi Seluruh Kegiatan
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
                <h6 class="m-0 font-weight-bold text-primary">Presensi Seluruh Kegiatan</h6>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="my-3">
                    <form method="GET" action="{{ route('data.presensi') }}">
                        <select name="kelompok" class="form-control col-3 d-inline-block">
                            <option value="">Pilih Kelompok</option>
                            @forelse ($kelompoks as $kelompok)
                                <option value="{{ $kelompok->kelompok }}"
                                    {{ $kelompok->kelompok == request()->get('kelompok') ? 'selected' : '' }}>
                                    {{ $kelompok->kelompok }}
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada kelompok</option>
                            @endforelse
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Kelompok</th>
                                @foreach ($kegiatans as $kegiatan)
                                    <th>{{ $kegiatan->judul }}</th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calonAnggotas as $calonAnggota)
                                <tr>
                                    <td>{{ $calonAnggota->nama }}</td>
                                    <td>{{ $calonAnggota->nim }}</td>
                                    <td>{{ $calonAnggota->kelompok }}</td>
                                    @foreach ($kegiatans as $kegiatan)
                                        @foreach ($calonAnggota->absen as $absen)
                                            @if ($absen->kegiatan_id == $kegiatan->id)
                                                <td>{{ $absen->kehadiran == 0 ? 'X' : 'O' }}</td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td>{{ $calonAnggota->total_absen }}
                                    </td>
                                </tr>
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
                "order": [],
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": [,
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    "colvis"
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
