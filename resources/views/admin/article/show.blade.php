@extends('layouts.admin')
@section('title')
Tampilan Artikel
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Tampilan Artikel</h4>
                    <a href="{{ route('admin.article.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <img src="{{ $article->image_url }}" alt="" class="img-fluid">
                <h3 class="mb-4">{{ $article->title }}</h3>
                <div class="mb-4">
                    <strong>Tag:</strong>
                    @foreach($article->tags as $tag)
                    <label class="label label-info">{{ $tag->name }}</label>
                    @endforeach
                </div>
                {!! $article->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
