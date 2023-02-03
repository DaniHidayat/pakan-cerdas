@extends('layouts.admin')
@section('title')
Edit Artikel
@endsection

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Edit Artikel</h4>
                    <a href="{{ route('admin.article.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <form class="forms-sample" action="{{ route('admin.article.update',$article->slug) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Judul" value="{{ $article->title }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <select name="tag[]" id="tag" class="form-control select2" multiple>
                            <option value="">Pilih</option>
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->tag_id }}" {{ in_array($tag->tag_id,$article->tags->pluck('tag_id')->toArray()) ? 'selected' : ''}}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">Konten</label>
                        <textarea name="content" id="content" class="summernote">{!! $article->content !!}</textarea>
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
<script src="{{ asset('assets/vendors/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
@endsection

@push('script')
<script>
    $('.summernote').summernote();
    $('.select2').select2();
</script>
@endpush
