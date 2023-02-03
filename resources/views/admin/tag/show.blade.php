@extends('layouts.admin')
@section('title')
Detail Fisioterapis
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
                <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label">Nama</label>
                    <div class="col-sm-1 col-form-label">:</div>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control-plaintext" id="name" placeholder="Nama" value="{{ $fisio->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-1 col-form-label">Email</label>
                    <div class="col-sm-1 col-form-label">:</div>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control-plaintext" id="email" placeholder="Email" value="{{ $fisio->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-1 col-form-label">No HP</label>
                    <div class="col-sm-1 col-form-label">:</div>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control-plaintext" id="phone" placeholder="No HP" value="{{ $fisio->phone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-1 col-form-label">Alamat</label>
                    <div class="col-sm-1 col-form-label">:</div>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control-plaintext" id="address" rows="4" readonly>{{ $fisio->address }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection