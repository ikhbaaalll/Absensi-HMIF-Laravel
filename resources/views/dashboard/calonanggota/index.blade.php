@extends('master.dashboard')

@section('title-page')
Daftar Calon Anggota
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Calon Anggota</h6>
        </div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
            @endif
            <div class="my-3">
                <a href="{{route('calonanggota.create')}}" class="btn btn-primary">Tambah Calon Anggota</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>QR Code</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($calonAnggotas as $calonAnggota)
                        <tr>
                            <td>{{$calonAnggota->nama}}</td>
                            <td>{{$calonAnggota->nim}}</td>
                            <td>{{$calonAnggota->prodi}}</td>
                            <td>{{$calonAnggota->qr_code}}</td>
                            <td>
                                <a href="{{ route('calonanggota.edit', ['calonanggotum' => $calonAnggota]) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form class="d-inline"
                                    action="{{route('calonanggota.destroy', ['calonanggotum' => $calonAnggota])}}"
                                    method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus {{$calonAnggota->nama}}')"
                                        class="btn btn-sm btn-danger d-inline-block">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty($calonAnggotas)
                        <tr>
                            <td colspan="5">Tidak ada data kegiatan</td>
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