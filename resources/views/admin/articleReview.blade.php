@extends('app')

@section('title', '管理画面')

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <main>
    <div class="container">
      <div>
        <div class="mt-5 d-flex justify-content-between">
          <div class="h4">{{ $article->title }}へのレビュー一覧</div>
        </div>

        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <table class="table">
          <thead>
            <tr>
              <th>id</th>
              <th>投稿者</th>
              <th>評価</th>
              <th>内容</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($article->reviews as $review)
              <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->user->name }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->body }}</td>
                <td class="text-right">
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $review->id }}">削除</a>

                  <!-- modal -->
                  <div id="modal-delete-{{ $review->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ route('admin.destroyReview', ['review' => $review]) }}">
                          @csrf
                          @method('DELETE')
                          <div class="modal-body">
                              このコメントを削除します。よろしいですか？
                          </div>
                          <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- modal -->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </main>

@endsection
