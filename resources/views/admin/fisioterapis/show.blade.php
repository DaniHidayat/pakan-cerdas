@extends('layouts.admin')
@section('title')
Detail Fisioterapis
@endsection

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Detail Fisioterapis</h4>
                    <a href="{{ route('admin.fisioterapis.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <div class="row">
                    <div class="col-sm-12">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 15%">Nama</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $fisio->name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Email</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $fisio->email }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%">No HP</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $fisio->phone }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%" class="align-top">Alamat</td>
                                <td style="width: 5%" class="align-top">:</td>
                                <td>{{ $fisio->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Jadwal</h4>
                    <a class="btn btn-primary" href="{{ route('admin.fisioterapis.schedule.create',$fisio->fisioterapis_id) }}">
                        <i class="mdi mdi-calendar-plus mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table datatables">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hari</th>
                                        <th>Tipe</th>
                                        <th>Dari</th>
                                        <th>Sampai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($fisio->schedules as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ $schedule->type }}</td>
                                    <td>{{ $schedule->from }}</td>
                                    <td>{{ $schedule->to }}</td>
                                    <td>
                                        <a class="btn btn-info"
                                            href="{{ route('admin.fisioterapis.schedule.edit',['fisioterapi' => $fisio->fisioterapis_id,'schedule' => $schedule->schedule_id]) }}">
                                            <i class="mdi mdi-pencil mdi-24px mx-0"></i>
                                        </a>
                                        <form action="{{ route('admin.fisioterapis.schedule.destroy',['fisioterapi'=>$fisio->fisioterapis_id,'schedule'=>$schedule->schedule_id]) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">
                                                <i class="mdi mdi-delete mdi-24px mx-0"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Hari</th>
                                        <th>Tipe</th>
                                        <th>Dari</th>
                                        <th>Sampai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-js')
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
@endsection

@push('script')
<script>
    $('.datatables').DataTable();
</script>
@endpush