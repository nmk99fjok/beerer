@extends('app')

@section('title', 'Beerer!')

@section('content')
  <header>
    @include('nav')
    <div class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(image/1197922_m.jpg);
                                                                     background-repeat: no-repeat;
                                                                     background-size: cover;
                                                                     background-position: center center;">
      <div class="mask rgba-black-light">
        <div class="container h-100 d-flex justify-content-center align-items-center">
          <div class="row pt-5 mt-3">
            <div class="col-md-12">
              <div class="text-center">
                <h1 class="h1-reponsive
                           white-text
                           text-uppercase
                           font-weight-bold
                           mb-3
                           wow
                           fadeInDown"
                    data-wow-delay="0.3s">
                    <strong>お気に入りのビールを見つけましょう</strong>
                </h1>
                <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s"/>
                <a href="{{ route('user.register') }}" class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.5s">新規登録</a>
                <p class="white-text mt-2 wow fadeInDown" data-wow-delay="0.5s">or</p>
                <h2 class="white-text wow fadeInDown" data-wow-delay="0.6s">
                  さっそく探す
                </h2>
                <h2 class="white-text mt-4 wow fadeInDown" data-wow-delay="0.6s">
                  <i class="fas fa-angle-double-down"></i>
                </h2>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mt-5">
          <section class="pb-5">
            <h4 class="text-center">
              <i class="fas fa-glass-cheers"></i>今日の一杯
            </h4>
            <hr class="border-primary" />

            @if(isset($todayArticle))
              <div class="row">
                <div class="col-md-4">
                  <img class="img-fluid" src="{{ asset('storage/images/' . $todayArticle->image) }}" alt="" />
                </div>
                <div class="col-md-8 my-3">
                  <h4 class="font-weight-bold">サッポロ生ビール黒ラベル</h4>
                  <star-rating :star-size="30"
                                :read-only="true"
                                :show-rating="false"
                                :rating="{{ $todayArticle->reviews_avg }}"
                                >
                  </star-rating>
                  <p class="py-3">
                    {!! nl2br(e(Str::limit($todayArticle->body, 100))) !!}
                  </p>
                  <a class="border-bottom" href="{{ route('articles.show', ['article' => $todayArticle]) }}">詳しくみる<i class="fas fa-angle-double-right ml-2"></i></a>
                </div>
              </div>
            @endif

          </section>

          <section class="text-center">
            <h4><i class="fas fa-beer"></i>人気のビール</h4>
            <hr class="border-primary" />
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
