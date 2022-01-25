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
                <h2 class="h3 card-title text-center mt-2">新しいパスワードの入力</h2>

                @include('error_message')

                <div class="card-text">
                  <form action="{{ route('user.password.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="md-form">
                      <label for="email">新しいパスワード</label>
                      <input class="form-control" type="password" id="password" name="password" required>
                    </div>

                    <div class="md-form">
                      <label for="email">新しいパスワード(再入力)</label>
                      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">送信</button>

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
