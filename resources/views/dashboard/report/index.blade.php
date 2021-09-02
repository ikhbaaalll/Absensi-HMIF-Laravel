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
            <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tempat</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatans as $kegiatan)
                        <tr>
                            <td>{{$kegiatan->judul}}</td>
                            <td>{{$kegiatan->tempat}}</td>
                            <td>{{$kegiatan->waktu->format('d-m-Y H:i')}}</td>
                            <td>
                                <a href="{{ route('kegiatan.show', $kegiatan) }}"
                                    class="btn btn-sm btn-primary">Presensi</a>
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