@extends('layouts.admin')
@section('title')
Edit Biaya
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Edit Biaya</h4>
                    <a href="{{ route('admin.price.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <form class="forms-sample" action="{{ route('admin.price.update',$price->price_id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama" value="{{ !empty(old('name')) ? old('name') : $price->name }}">
                    </div>
                    <div class="form-group">
                        <label for="amount">Harga</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Harga" value="{{ !empty(old('amount')) ? old('amount') : $price->amount }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($types as $type)
                            <option value="{{ $type }}" {{ empty(old('type')) && $price->type == $type || old('type')==$type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection