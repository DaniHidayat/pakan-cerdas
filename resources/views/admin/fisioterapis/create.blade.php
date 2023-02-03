@extends('layouts.admin')
@section('title')
Tambah Fisioterapis
@endsection

@section('vendor-css')
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/image-uploader/image-uploader.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Tambah Fisioterapis</h4>
                    <a href="{{ route('admin.fisioterapis.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <form class="forms-sample" action="{{ route('admin.fisioterapis.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Konfirmasi Password">
                    </div>
                    <div class="form-group">
                        <label for="phone">No HP</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="No HP" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label for="about">Tentang</label>
                        <textarea name="about" class="form-control" id="about" rows="4" placeholder="Alamat">{{ old('about') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="No HP" value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto Profil</label>
                        <input type="file" name="photo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Foto Profil">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea name="address" class="form-control" id="address" rows="4" placeholder="Alamat">{{ old('address') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="village">Desa</label>
                        <input type="text" name="village" class="form-control" id="village" placeholder="Desa" value="{{ old('village') }}">
                    </div>
                    <div class="form-group">
                        <label for="district">Kecamatan</label>
                        <input type="text" name="district" class="form-control" id="district" placeholder="Kecamatan" value="{{ old('district') }}">
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="Kota" value="{{ old('city') }}">
                    </div>
                    <div class="form-group">
                        <label for="province">Provinsi</label>
                        <input type="text" name="province" class="form-control" id="province" placeholder="Provinsi" value="{{ old('province') }}">
                    </div>
                    <div class="form-group">
                        <label for="galery">Galeri <small>(minimal 1)</small></label>
                        <div class="input-images"></div>
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
<script type="text/javascript" src="{{ asset('assets/vendors/image-uploader/image-uploader.min.js') }}"></script>
@endsection

@push('script')
<script>
    $('.input-images').imageUploader();
</script>
@endpush
