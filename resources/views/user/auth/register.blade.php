@extends('app')

@section('title', 'ユーザー登録')

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
                                <h2 class="h3 card-title text-center mt-2">新規登録</h2>

                                <div class="card-text">
                                    <form method="POST" action="{{ route('user.register') }}">
                                        @csrf
                                        <div class="md-form">
                                            <label for="name">ユーザー名</label>
                                            <input class="form-control" type="text" id="name" name="name" required
                                                value="{{ old('name') }}">
                                            <small>3〜20文字(登録後の変更はできません)</small>
                                        </div>
                                        <div class="md-form">
                                            <label for="email">メールアドレス</label>
                                            <input class="form-control" type="text" id="email" name="email" required
                                                value="{{ old('email') }}">
                                        </div>
                                        <div class="md-form">
                                            <label for="password">パスワード</label>
                                            <input class="form-control" type="password" id="password" name="password"
                                                required>
                                        </div>
                                        <div class="md-form">
                                            <label for="password_confirmation">パスワード(確認)</label>
                                            <input class="form-control" type="password" id="password_confirmation"
                                                name="password_confirmation" required>
                                        </div>
                                        <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ユーザー登録</button>
                                    </form>

                                    <div class="mt-0">
                                        <a href="{{ route('user.login') }}" class="card-text">ログインはこちら</a>
                                    </div>

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
