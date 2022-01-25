@extends('app')

@section('title', '管理画面')

@section('content')
  @include('nav')
  <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

  <main>
    <div class="container">
      <div>
        <div class="mt-5 d-flex justify-content-between">
          <div class="h4">記事一覧</div>
          <div>
            <a class="btn btn-primary" href="{{ route('articles.create') }}">記事を投稿する</a>
          </div>
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
              <th>記事タイトル</th>
              <th>メーカー</th>
              <th>内容</th>
              <th>レビュー</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($articles as $article)
              <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->maker }}</td>
                <td>{{ $article->body }}</td>
                <td>
                  <a class="btn btn-primary" href="{{ route('admin.articleReview', ['article' => $article]) }}">一覧</a>
                </td>
                <td class="text-right">
                  <a class="btn btn-warning" href="{{ route('articles.edit', ['article' => $article]) }}">編集</a>
                  <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">削除</a>

                  <!-- modal -->
                  <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                          @csrf
                          @method('DELETE')
                          <div class="modal-body">
                            {{ $article->title }}を削除します。よろしいですか？
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

        {{ $articles->links() }}
      </div>
    </div>
  </main>

@endsection
