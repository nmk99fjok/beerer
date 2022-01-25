@extends('app')

@section('title', '記事投稿')

@section('content')
    @include('nav')
    <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @include('error_message')
          <form method="POST" class="border border-light p-5 mt-5" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>ビール記事投稿フォーム</h3>

            @include('articles.form')
            <button type="submit" class="btn btn-primary">投稿する</button>
          </form>
        </div>
      </div>
    </div>
@endsection
