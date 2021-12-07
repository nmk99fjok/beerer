@extends('app')

@section('title', 'タグで見つける')

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mt-5">
          <section class="text-center">
            <h4>タグ一覧</h4>
            <h6>{{ $tags->count() }}件</h6>
            <hr class="border-primary">

            <div class="row">
              @foreach ($tags as $tag)
                <div class="col-6 col-sm-4 pt-3 pb-3">
                  <a class="text-dark" href="{{ route('tags.show', ['name' => $tag['name']]) }}"><i class="fas fa-tag text-info pr-1"></i>{{ $tag['name'] }}</a>
                </div>
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
