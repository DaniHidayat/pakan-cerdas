@extends('layouts.admin')
@section('title')
Ubah Jadwal
@endsection

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('assets/vendors/jquery-timepicker/jquery.timepicker.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Ubah Jadwal - {{ $fisio->name }}</h4>
                    <a href="{{ route('admin.fisioterapis.show', $fisio->fisioterapis_id) }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <form class="forms-sample"
                    action="{{ route('admin.fisioterapis.schedule.update', ['fisioterapi'=>$fisio->fisioterapis_id, 'schedule'=>$schedule->schedule_id]) }}"
                    method="POST" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="day">Hari</label>
                        <select name="day" id="day" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($days as $day)
                            <option value="{{ $day }}" {{ empty(old('day')) && $schedule->day == $day || old('day')==$day ? 'selected' : '' }}>{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($types as $type)
                            <option value="{{ $type }}" {{ empty(old('type')) && $schedule->type == $type || old('type')==$type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="from">Dari</label>
                        <input type="text" name="from" class="form-control timepicker" data-time-format='H:i' id="from" placeholder="Dari" value="{{ !empty(old('from')) ? old('from') : $schedule->from }}">
                    </div>
                    <div class="form-group">
                        <label for="to">Sampai</label>
                        <input type="text" name="to" class="form-control timepicker" data-time-format='H:i' id="to" placeholder="Sampai" value="{{ !empty(old('to')) ? old('to') : $schedule->to }}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-js')
<script src="{{ asset('assets/vendors/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
@endsection

@push('script')
<script>
    $('.timepicker').timepicker();
</script>
@endpush