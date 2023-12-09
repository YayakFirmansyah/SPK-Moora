@extends('layouts.template')

@section('title')
    Matriks Keputusan
@endsection


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Matriks Keputusan</h1>
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
                            <table id="mytable" class="display nowrap table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    @foreach ($kriteriabobot as $c)
                                        <th>{{$c->nama}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($alternatif as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @foreach ($kriteriabobot as $k)
                                            <td>
                                                @php
                                                    $s = $score->where('alternatif_id', $a->id)->where('kriteriabobot_id', $k->id)->first();
                                                @endphp
                                                {{ $s ? $s->score : '' }}
                                            </td>
                                        @endforeach
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
@endsection

@section('script')
<script>
    $(function () {
        $('#mytable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection
