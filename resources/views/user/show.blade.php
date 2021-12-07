@extends('app')

@section('title')

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mt-5">
          @include('user.card')

          <ul class="nav nav-tabs nav-justified mt-3">
            <li class="nav-item">
              <a href="{{ route('user.show', ['name' => $user->name]) }}" class="nav-link text-muted active">
                お気に入りした記事
              </a>
            </li>
          </ul>

          <section class="text-center">
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
