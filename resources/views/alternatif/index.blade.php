@extends('layouts.template')

@section('title')
    Alternatif & Value
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alternatif</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Alternatif Via Excel</h5>
                </div>
                <div class="card-body">
                    <form id="excelForm" method="post" action="{{ url('/uploadExcelAlternatif') }}"
                        class="d-flex justify-content-between align-items-center" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="excelFile">Select Excel File:</label>
                            <input type="file" class="form-control-file" id="excelFile" name="excel_file"
                                accept=".xlsx, .xls, .csv">
                        </div>
                        <div>
                            <a class="btn btn-primary" href="{{ url('/downloadExcelTemplateAlternatif') }}">Download
                                Template
                                Excel</a>
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
                                <a href="{{ route('alternatif.create') }}" class='btn btn-outline-success'>
                                    <span class='fa fa-plus'></span> Tambah Alternatif
                                </a>
                            </div>

                            <br>
                            <table id="mytable" class="display nowrap table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteriabobot as $c)
                                            <th>{{ $c->nama }}</th>
                                        @endforeach
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatif as $a)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $a->nama }}</td>
                                            @foreach ($kriteriabobot as $k)
                                                @php
                                                    // Menggunakan method first() untuk mendapatkan objek pertama yang cocok
                                                    $s = $scores
                                                        ->where('ida', $a->id)
                                                        ->where('idk', $k->id)
                                                        ->first();
                                                @endphp
                                                <td>{{ $s ? $s->score : '' }}</td>
                                            @endforeach
                                            <td>
                                                <span data-toggle="tooltip" data-placement="bottom" title="Edit Data">
                                                    <a href="{{ route('alternatif.edit', $a->id) }}"
                                                        class="btn btn-primary"><span class="fa fa-edit"></span>
                                                    </a>
                                                </span>
                                                <span data-toggle="tooltip" data-placement="bottom" title="Hapus Data">
                                                    <button type="button" onclick="deleteAlternatif({{ $a }})"
                                                        data-toggle="modal" data-target="#alternatifDeleteModal"
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
    <div class="modal fade" id="alternatifDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="alternatifModalBody">
                    <!-- Modal body content here -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <form method="POST" id="alternatifModalForm">
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
         * Update the [alternatifDeleteModal] based on the value of [alternatifObject]
         * - Parameter [alternatifObject] at least should have properties of [id] and [nama]
         */
        function deleteAlternatif(alternatifObject) {
            $('#alternatifModalBody').text(`Apakah anda yakin ingin menghapus alternatif ${alternatifObject.nama}?`)
            $('#alternatifModalForm').attr('action', `{{ route('alternatif.destroy', '') }}/${alternatifObject.id}`)
        }
    </script>
@endpush
