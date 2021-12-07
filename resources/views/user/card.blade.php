<div class="card mt-3">
  <div class="card-body d-flex flex-row">
      <i class="fas fa-user-circle fa-4x mr-1"></i>
      <div>
          <div class="font-weight-bold ml-3">
              <a href="{{ route('user.show', ['name' => $user->name]) }}" class="h4 text-dark">
                {{ $user->name }}
              </a>
          </div>
      </div>
  </div>

  <div class="card-body pt-0 pb-2">
    {{ $user->count_likes }}件のお気に入り
  </div>

</div>
