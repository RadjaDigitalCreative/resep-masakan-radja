<div class="panel recipe">
    <a class="link" href="{{ route('recipes.show', $recipe[0]->slug) }}">
        <img src="{{ URL::to('/') }}/img/recipes/{{ $recipe[0]->thumbnail }}" alt="" class="img-responsive">
        <div class="info">
            <div class="heading">
                {{ $recipe[0]->title }}
            </div>
        </div>
    </a>
</div>
