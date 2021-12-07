@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="md-form">
    <input type="text" name="title" class="form-control" placeholder="商品名" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="md-form">
    <input type="text" name="maker" class="form-control" placeholder="メーカー名" required value="{{ $article->maker ?? old('maker') }}">
</div>
<div class="md-form">
    <input type="text" name="price" class="form-control" placeholder="本体価格" required value="{{ $article->price ?? old('price') }}">
</div>
<div class="form-group">
  <article-tags-input
    :initial-tags='@json($tagNames ?? [])'
    :autocomplete-items='@json($allTagNames ?? [])'
  >
  </article-tags-input>
</div>
<div class="md-form">
    <span>商品画像</span>
    <div class="file-field">
        <div class="btn btn-primary btn-sm">
            <input type="file" name="image">
        </div>
    </div>
</div>
<div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control" rows="20" placeholder="本文">{{ $article->body ?? old('body') }}</textarea>
</div>
