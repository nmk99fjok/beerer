@extends('app')

@section('title', $tag->name)

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mt-5">
          <section class="text-center">
            <h4>{{ $tag->name }}</h4>
            <h6>{{ $tag->articles->count() }}件</h6>
            <hr class="border-primary">

            <div class="row">
              @foreach ($tag->articles as $article)
                @include('articles.card')
              @endforeach
            </div>

          </section>
        </div>
        <div class="col-md-4 mt-5">
          @include('sidebar')
        </div>
      </div>
    </div>
  </main>
@endsection
