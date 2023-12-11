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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div>
                                <a href="{{route('alternatif.create')}}" class='btn btn-outline-success'>
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
                                        <th>{{$c->nama}}</th>
                                    @endforeach
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($alternatif as $a)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $a->nama}}</td>
                                        @foreach ($kriteriabobot as $k)
                                            @php
                                                // Menggunakan method first() untuk mendapatkan objek pertama yang cocok
                                                $s = $scores->where('ida', $a->id)->where('idk', $k->id)->first();
                                            @endphp
                                            <td>{{ $s ? $s->score : '' }}</td>
                                        @endforeach
                                        <td>
                                            <span data-toggle="tooltip" data-placement="bottom"
                                                  title="Edit Data">
                                                <a href="{{ route('alternatif.edit',$a->id) }}"
                                                   class="btn btn-primary"><span class="fa fa-edit"></span>
                                                </a>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="bottom"
                                                  title="Hapus Data">
                                                <button type="button" onclick="deleteAlternatif({{ $a }})" data-toggle="modal" data-target="#alternatifDeleteModal" class="btn btn-danger">
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
    <div class="modal fade" id="alternatifDeleteModal" tabindex="-1" aria-labelledby="alternatifDeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus alternatif</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body" id="alternatifModalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
