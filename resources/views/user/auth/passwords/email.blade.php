@extends('app')

@section('title', 'パスワード再設定')

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <div class="container">
    <div class="row">
      <div class="col-md-8 mt-5">
        <div class="row">
          <div class="mx-auto col col-12 col-sm-11">
            <div class="card mt-3">
              <div class="card-body text-center">
                <h2 class="h3 card-title text-center mt-2">パスワード再設定</h2>

                @include('error_message')

                @if (session('status'))
                <div class="card-text alert alert-success">
                  {{ session('status') }}
                </div>
                @endif

                <div class="card-text">
                  <form action="{{ route('user.password.email') }}" method="POST">
                    @csrf

                    <div class="md-form">
                      <label for="email">メールアドレス</label>
                      <input class="form-control" type="text" id="email" name="email" required>
                    </div>

                    <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">メール送信</button>

                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mt-5">
        @include('sidebar')
      </div>
    </div>
  </div>
@endsection
