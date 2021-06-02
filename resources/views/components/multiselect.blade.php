<select name="{{ $field }}[]" id="{{ $field }}" class="select form-control" multiple="multiple">
    @foreach ($data as $id => $name)
        @if (collect(old($field))->contains($id) || $data2->contains($id))
            <option value="{{ $id }}" selected>{{ $name }}</option>
        @else
            <option value="{{ $id }}">{{ $name }}</option>
        @endif
    @endforeach
</select>
