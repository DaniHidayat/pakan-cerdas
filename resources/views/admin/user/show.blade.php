@extends('layouts.admin')
@section('title')
Detail Pasien
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
                    <h4 class="card-title">Detail Pasien</h4>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <h4>Kontak</h4>
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 15%">Nama</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%">Email</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%">No HP</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%" class="align-top">Alamat</td>
                                <td style="width: 5%" class="align-top">:</td>
                                <td>{{ $user->full_address }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <h4>Informasi Diri</h4>
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 25%">Jenis Kelamin</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $user->gender == 'Male' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%">Tanggal Lahir</td>
                                <td style="width: 5%">:</td>
                                <td>{{ \Carbon\Carbon::parse($user->birth_date)->isoFormat('DD MMMM YYYY') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%">Tinggi Badan</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $user->height }} cm</td>
                            </tr>
                            <tr>
                                <td style="width: 25%">Berat Badan</td>
                                <td style="width: 5%">:</td>
                                <td>{{ $user->weight }} kg</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Riwayat Konsultasi</h4>
            </div>
            <p class="card-description"></p>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Fisioterapis</th>
                                    <th>Tipe</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->created_at)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td>{{ $booking->fisioterapis->name }}</td>
                                    <td>{{ $booking->schedule->type }}</td>
                                    <td>{{ $booking->start }} - {{ $booking->end }}</td>
                                    <td>{{ $booking->status }}</td>
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
