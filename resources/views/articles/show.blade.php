@extends('app')

@section('title', $article->title)

@section('content')
    @include('nav')
    <img src="{{ asset('image/1197922_m.jpg') }}" style="width: 100%; height: 200px; object-fit: cover;" alt="">

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-5">
                    <!-- 商品詳細 -->
                    <section class="text-center">
                        <h4><i class="fas fa-beer"></i>商品詳細</h4>
                        <hr class="border-primary" />
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <img class="img-fluid" src="{{ asset('storage/images/' . $article->image) }}" alt=""
                                    style="width: 100%; height: 300px; object-fit: contain;">
                            </div>
                            <div class="col-md-6 text-md-left">
                                <span class="grey-text">{{ $article->maker }}</span>
                                <h3>{{ $article->title }}</h3>

                                @foreach($article->tags as $tag)
                                  @if($loop->first)
                                    <div class="card-body p-0 mb-2">
                                      <div class="card-text" style="line-height: 2rem">
                                  @endif
                                        <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                                          {{ $tag->name }}
                                        </a>
                                  @if($loop->last)
                                      </div>
                                    </div>
                                  @endif
                                @endforeach

                                <star-rating :star-size="30"
                                             :read-only="true"
                                             :show-rating="false"
                                             :rating="{{ $article->reviews_avg }}"
                                             >
                                </star-rating>
                                <h4 class="pt-3">約<strong>{{ $article->price }}</strong>円</h4>
                            </div>
                        </div>
                        <div class="h4 pt-5 pl-5 text-md-left">
                            <p>{!! nl2br(e($article->body)) !!}</p>
                        </div>
                    </section>
                    <!-- ここまで -->

                    <!-- クチコミ一覧 -->
                    <section class="pt-5">
                        <h4 class="text-center">クチコミ一覧</h4>
                        <hr class="border-primary" />
                          <div class="">
                            @foreach($reviews as $review)
                              <div class="card mt-3">
                                  <div class="card-body d-flex flex-row">
                                      <i class="fas fa-user-circle fa-4x mr-1"></i>
                                      <div>
                                          <div class="h5 ml-3">
                                            <a href="{{ route('user.show', ['name' => $review->user->name]) }}" class="text-dark">
                                              {{ $review->user->name }}
                                            </a>
                                          </div>
                                          <div class="font-weight-lighter ml-3">
                                            {{ $review->created_at->format('Y/m/d H:i') }}
                                          </div>
                                      </div>
                                  </div>
                                  <div class="card-body pt-0 pb-2">
                                      <div>
                                          <star-rating :star-size="20"
                                                       :read-only="true"
                                                       :rating="{{ $review->rating }}"
                                                       >
                                          </star-rating>
                                      </div>
                                      <div class="h4 mt-3">
                                          {!! nl2br(e($review->body)) !!}
                                      </div>
                                  </div>
                              </div>
                            @endforeach

                            <div class="d-flex justify-content-center pt-5">
                              {{ $reviews->links() }}
                            </div>
                          </div>
                    </section>
                    <!-- ここまで -->

                    @include('error_message')

                    <!-- 投稿フォーム -->
                    @auth('user')
                      @unless($article->isReviewed(Auth::user()))
                        <section class="pt-5">
                          <form id="store" action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input id="store" type="hidden" name="article_id" value="{{ $article->id }}">
                            <input id="store" type="hidden" name="rating" :value="rating" >
                            <star-rating @rating-selected="setRating">
                            </star-rating>
                            <div class="form-group">
                              <label></label>
                              <textarea name="body" required class="form-control" rows="5" placeholder="コメントする"></textarea>
                            </div>
                            <button id="store" type="submit" class="btn btn-primary">投稿する</button>
                          </form>
                        </section>
                      @endunless

                      @if($article->isReviewed(Auth::user()) && isset($userReview))
                        <section class="py-5">
                          <button class="btn btn-primary"
                                  data-toggle="collapse"
                                  data-target="#updateReview"
                                  aria-expand="false"
                                  aria-controls="updateReview"
                          >
                          コメントを編集する
                          </button>

                          <!-- collapse menu -->
                          <div class="collapse" id="updateReview">
                            <form id="update" action="{{ route('reviews.update', ['review' => $userReview]) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="article_id" value="{{ $article->id }}">
                              <input type="hidden" name="rating" :value="rating" >
                              <star-rating @rating-selected="setRating"
                                           rating="{{ $userReview->rating }}">
                              </star-rating>
                              <div class="form-group">
                                <label></label>
                                <textarea name="body" class="form-control" rows="5" placeholder="コメントする">{{ $userReview->body ?? old('body') }}</textarea>
                              </div>
                              <button id="update" type="submit" class="btn btn-primary">更新する</button>
                              <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $userReview->id }}">削除する</a>
                            </form>
                          </div>
                          <!-- ここまで -->

                          <!-- modal menu -->
                          <div id="modal-delete-{{ $userReview->id }}" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ route('reviews.destroy', ['review' => $userReview]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <input type="hidden" name="body" value="削除">
                                  <div class="modal-body">
                                    コメントを削除しますか？
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                    <button type="submit" class="btn btn-danger">削除する</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- ここまで -->
                        </section>
                      @endif
                    @endauth
                    <!-- ここまで -->
                </div>
                <div class="col-md-4 mt-5">
                    @include('sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection
