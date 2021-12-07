@extends('app')

@section('title', 'ビール一覧')

@section('content')
    @include('nav')
    <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-5">
                    <section class="text-center">
                        <h4>
                          @if (!empty($search))
                            {{ $search }}の検索結果
                          @else
                            ビール一覧
                          @endif
                        </h4>
                        <hr class="border-primary">

                        <!-- 商品欄 -->
                        <div class="row">
                          @foreach($articles as $article)
                            @include('articles.card')
                          @endforeach

                          {{ $articles->appends([
                            'search' => $search
                          ])->links() }}
                        </div>
                        <!-- ここまで -->

                    </section>
                </div>
                <div class="col-md-4 mt-5">
                    @include('sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection
