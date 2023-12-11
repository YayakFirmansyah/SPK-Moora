@extends('layouts.template')

@section('title')
    Kriteria & Bobot
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kriteria & Bobot</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Kriteria Via Excel</h5>
                </div>
                <div class="card-body">
                    <form id="excelForm" method="post" action="{{ url('/uploadExcelKriteria') }}"
                        class="d-flex justify-content-between align-items-center" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="excelFile">Select Excel File:</label>
                            <input type="file" class="form-control-file" id="excelFile" name="excel_file"
                                accept=".xlsx, .xls, .csv">
                        </div>
                        <div>
                            <a class="btn btn-primary" href="{{ url('/downloadExcelTemplateKriteria') }}">Download Template Excel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <a href="{{ route('kriteriabobot.create') }}" class='btn btn-outline-success'>
                                    <span class='fa fa-plus'></span> Tambah Kriteria
                                </a>
                            </div>

                            <br>
                            <table id="mytable" class="display nowrap table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Tipe</th>
                                        <th>Bobot</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteriabobot as $c)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $c->nama }}</td>
                                            <td>{{ $c->tipe }}</td>
                                            <td>{{ $c->bobot }}</td>
                                            <td>{{ $c->description }}</td>
                                            <td>
                                                <span data-toggle="tooltip" data-placement="bottom" title="Edit Data">
                                                    <a href="{{ route('kriteriabobot.edit', $c->id) }}"
                                                        class="btn btn-primary"><span class="fa fa-edit"></span>
                                                    </a>
                                                </span>
                                                <span data-toggle="tooltip" data-placement="bottom" title="Hapus Data">
                                                    <button type="button" onclick="deleteKriteria({{ $c }})"
                                                        data-toggle="modal" data-target="#kriteriaDeleteModal"
                                                        class="btn btn-danger">
                                                        <span class="fa fa-trash-alt"></span>
                                                    </button>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="kriteriaDeleteModal" tabindex="-1" aria-labelledby="kriteriaDeleteModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kriteria</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body" id="kriteriaModalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form method="POST" id="kriteriaModalForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    @if ($message = Session::get('success'))
        <script>
            toastr.success('{{ $message }}')
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            toastr.error('{{ $message }}')
        </script>
    @endif
    <script>
        /*
         * Update the [kriteriaDeleteModal] based on the value of [kriteriaObject]
         * - Parameter [kriteriaObject] at least should have properties of [id] and [nama]
         */
        function deleteKriteria(kriteriaObject) {
            $('#kriteriaModalBody').text(`Apakah anda yakin ingin menghapus kriteria ${kriteriaObject.nama}?`)
            $('#kriteriaModalForm').attr('action', `{{ route('kriteriabobot.destroy', '') }}/${kriteriaObject.id}`)
        }
    </script>
@endpush
