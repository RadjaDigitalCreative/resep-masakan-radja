<table id="myTable"  class="table table-hover" data-table="{{ $table }}">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th class="text-right">Tanggal</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr {{ $item->deleted_at ? 'class=text-danger' : '' }}>
                <td>{{ $item->id }}</td>
                <td title="{{ $item->slug }}">
                    {{ $item->name }}
                </td>
                <td class="text-right">
                    {{ $item->updated_at->format('G:i j. n. Y') }}
                </td>
                <td class="text-right cell-buttons">
                    <a href="{{ route('admin.' . $table . '.edit', $item->id) }}">
                        <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
