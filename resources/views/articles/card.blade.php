<div class="col-md-4 py-3">
  <div class="row">
      <div class="col-md-12 col-6">
          <a href="{{ route('articles.show', ['article' => $article]) }}" class="waves-effect waves-light img-trim">
              <img src="{{ asset('storage/images/' . $article->image) }}" class="img-fluid" alt="" />
          </a>
      </div>
      <div class="col-md-12 col-6 my-auto">
          <div class="font-weight-bold black-text">{{ $article->title }}</div>

          <p class="mb-1">
              <small>約</small>
              <strong class="indigo-text">{{ $article->price }}</strong>
              <small>円</small>
          </p>

          <div>
          <star-rating style="justify-content: center;"
                              :read-only="true"
                              :star-size="20"
                              :show-rating="false"
                              :rating="{{ $article->reviews_avg }}">
          </star-rating>
          </div>

          <button type="button" class="btn
                                       shadow-none
                                       btn-sm
                                       px-3
                                       btn-outline-indigo
                                       rounded-pill
                                       waves-effect
                                      ">
              <a href="{{ route('articles.show', ['article' => $article]) }}">レビュー</a>
              <i class="far fa-comment-dots fa-lg"></i>
          </button>

          <article-like
              :initial-is-liked-by="@json($article->isLikedBy(Auth::user()))"
              :authorized='@json(Auth::check())'
              endpoint="{{ route('articles.like', ['article' => $article]) }}"
          >
          </article-like>
      </div>
  </div>
</div>
