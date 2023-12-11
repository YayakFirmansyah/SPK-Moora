@extends('layouts.template')

@section('title')
    Ranking
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perankingan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="rankingTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Alternatif</th>
                                        <th>Yi Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hitungYi as $alternatifId => $alternatifData)
                                        <tr>
                                            <td>{{ $alternatifData['ranking'] }}</td>
                                            <td>{{ $alternatif->where('id', $alternatifId)->first->nama['nama'] }}</td>
                                            <td>
                                                @if (isset($alternatifData['yiValue']))
                                                    {{ $alternatifData['yiValue'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Alternatif</th>
                                        <th>Yi Value</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        $(function() {
            $("#rankingTable").DataTable({
                "responsive": true,
                "lengthChange": true, // Allow changing number of items shown
                "lengthMenu": [5, 10, 20, 50, 100], // Options for items per page
                "pageLength": 20, // Default number of items shown per page
                "autoWidth": false,
                "searching": true, // Enable search field
            }).buttons().container().appendTo('#rankingTable_wrapper .col-md-6:eq(0)');

        });
    </script>
@endpush
