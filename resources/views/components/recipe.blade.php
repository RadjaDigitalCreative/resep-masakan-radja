<div class="panel recipe">
    <a class="link" href="{{ route('recipes.show', $recipe->slug) }}">
        <img src="{{ URL::to('/') }}/img/recipes/{{ $recipe->thumbnail }}" alt="" class="img-responsive">
        @if ($recipe->liked())
        <i class="glyphicon glyphicon-heart"></i>
        @endif
        <div class="info">
            <div class="heading">
                {{ $recipe->title }}
            </div>
            <div class="categories">
                {{ implode($recipe->categories->pluck('name')->toArray(), ', ') }}
            </div>
        </div>
        <div class="info">
            <div class="categories">
                <form method="POST" action="{{ route('recipes.like', $recipe->id) }}" class="inline" >
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">
                        {{ $recipe->liked() ? 'Favorit' : 'Tambah Favorit' }}
                    </button>
                </form>
            </div>
        </div>
    </a>
</div>
