@extends('layouts.admin')
@section('title')
Tampilan Video
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Tampilan Video</h4>
                    <a href="{{ route('admin.video.index') }}" class="btn btn-primary">
                        <i class="mdi mdi-arrow-left mdi-18px"></i>
                    </a>
                </div>
                <p class="card-description"></p>
                <div class="embed-responsive embed-responsive-16by9">
                    <video src="{{ $video->video_url }}" controls class="embed-responsive-item"></video>
                </div>
                <h3 class="mb-4">{{ $video->title }}</h3>
                {{ $video->description }}
            </div>
        </div>
    </div>
</div>
@endsection
