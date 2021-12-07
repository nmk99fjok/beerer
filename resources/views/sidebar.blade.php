<section>
    <h4 class="text-center">
        <i class="fas fa-search" aria-hidden="true"></i>ビールを探す
    </h4>

    <form action="{{ route('articles.index') }}">
      <div class="input-group w-75 mx-auto mb-5">
        <input class="form-control" type="text" name="search" value="{{ $search ?? '' }}" placeholder="検索">
        <span class="input-group-append">
          <button class="input-group-text" type="submit"><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
        </span>
      </div>
    </form>

    <div class="w-75 mx-auto">
        <div class="mb-3 card rounded-0 shadow-none border">
            <div class="card-header">
                <h6 class="mb-0 font-weight-bold">
                  一覧で探す
                </h6>
            </div>
            <div class="">
                <ul class="list-group list-group-flush">
                  <form action="{{ route('articles.index') }}">
                    <a class="list-group-item list-group-item-action" href="{{ route('articles.index') }}">
                      <i class="fas fa-angle-right text-info"></i>&ensp;一覧を見る
                    </a>
                    <button class="list-group-item list-group-item-action" type="submit" name="sort" value="sortReviewCount">
                      <i class="fas fa-angle-right text-info"></i>&ensp;コメント数順
                    </button>
                    <button class="list-group-item list-group-item-action" type="submit" name="sort" value="sortRating">
                      <i class="fas fa-angle-right text-info"></i>&ensp;評価順
                    </button>
                    <button class="list-group-item list-group-item-action" type="submit" name="sort" value="sortNewArrival">
                      <i class="fas fa-angle-right text-info"></i>&ensp;新着
                    </button>
                  </form>
                </ul>
            </div>
        </div>

        <div class="mb-3 card rounded-0 shadow-none border">
          <div class="card-header">
              <h6 class="mb-0 font-weight-bold">
                </i>メーカーから探す
              </h6>
          </div>
          <div class="">
              <ul class="list-group list-group-flush">
                  <a class="list-group-item list-group-item-action" href="{{ route('articles.makerShow', ['name' => 'アサヒ']) }}">
                    <i class="fas fa-building text-info"></i>&ensp;アサヒ
                  </a>
                  <a class="list-group-item list-group-item-action" href="{{ route('articles.makerShow', ['name' => 'キリン']) }}">
                    <i class="fas fa-building text-info"></i>&ensp;キリン
                  </a>
                  <a class="list-group-item list-group-item-action" href="{{ route('articles.makerShow', ['name' => 'サントリー']) }}">
                    <i class="fas fa-building text-info"></i>&ensp;サントリー
                  </a>
                  <a class="list-group-item list-group-item-action" href="{{ route('articles.makerShow', ['name' => 'サッポロ']) }}">
                    <i class="fas fa-building text-info"></i>&ensp;サッポロ
                  </a>
                  <a class="text-info text-center list-group-item list-group-item-action" href="{{ route('articles.maker')}}">
                    もっと見る
                  </a>
              </ul>
          </div>
        </div>

        <div class="mb-3 card rounded-0 shadow-none border">
            <div class="card-header">
                <h6 class="mb-0 font-weight-bold">
                  </i>タグで見つける
                </h6>
            </div>
            <div class="">
                <ul class="list-group list-group-flush">
                  @foreach ($getCountTag as $value)
                    <a class="list-group-item list-group-item-action" href="{{ route('tags.show', ['name' => $value->name]) }}">
                      <i class="fas fa-tag text-info"></i>&ensp;{{ $value->name }}
                    </a>
                  @endforeach
                  <a class="text-info text-center list-group-item list-group-item-action" href="{{ route('tags.index') }}">
                    もっと見る
                  </a>
                </ul>
            </div>
        </div>
    </div>
</section>
