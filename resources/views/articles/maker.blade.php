@extends('app')

@section('title', 'メーカー')

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mt-5">
          <section class="text-center">
            <h4>メーカー一覧</h4>
            <h6>{{ $makers->count() }}件</h6>
            <hr class="border-primary">

            <div class="row">
              @foreach ($makers as $maker)
                <div class="col-6 col-sm-4 pt-2 pb-2">
                  <a class="text-dark" href="{{ route('articles.makerShow', ['name' => $maker['maker']]) }}"><i class="far fa-building text-info pr-1"></i>{{ $maker['maker'] }}</a>
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
