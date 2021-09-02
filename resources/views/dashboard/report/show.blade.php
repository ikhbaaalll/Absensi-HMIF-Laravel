@extends('master.dashboard')

@section('title-page')
Absensi Kegiatan {{$kegiatan->judul}}
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
            <h6 class="m-0 font-weight-bold text-primary">Absensi Kegiatan {{$kegiatan->judul}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Program Studi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan->absen as $absen)
                        <tr>
                            <td>{{$absen->nama}}</td>
                            <td>{{$absen->nim}}</td>
                            <td>{{$absen->prodi}}</td>
                        </tr>
                        @empty($kegiatans)
                        <tr>
                            <td colspan="3">Tidak ada data absensi</td>
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
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ['copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5', "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection