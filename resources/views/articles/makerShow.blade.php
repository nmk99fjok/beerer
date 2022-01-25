@extends('app')

@section('title', $makerName)

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mt-5">
          <section class="text-center">
            <h4>{{ $makerName }}</h4>
            <h6>{{ $articles->count() }}件</h6>
            <hr class="border-primary">

            <div class="row">
              @foreach ($articles as $article)
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
