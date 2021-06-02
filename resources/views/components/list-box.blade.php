<div class="list-heading">
    {{ $heading }}
</div>
<ul class="list-group">
    @foreach ($data as $item)
        <li class="list-group-item">
            {{ $item->name }}
        </li>
    @endforeach
</ul>
