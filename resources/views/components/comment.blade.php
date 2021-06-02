<div class="comment row">
    <div class="col-sm-1">
        @if ($comment->user)
        <a href="{{ route('user.profile', $comment->user->slug) }}" title="{{ $comment->user->name }}">
          <img src="{{ URL::to('/') }}/img/avatars/{{ $comment->user->avatar }}" class="avatar-img" alt="{{ $comment->user->name }}">
      </a>
      @else
      <img src="{{ asset('img/avatars/default.png') }}" class="avatar-img" alt="">
      @endif
  </div>
  <div class="col-sm-11">
    @if ($comment->user)
    <a class="name" href="{{ route('user.profile', $comment->user->slug) }}">{{ $comment->user->name }}</a>
    @endif
    <em>{{ $comment->created_at->format('j. n. Y') }}</em><br>
    {{ $comment->body }}
</div>
</div>
