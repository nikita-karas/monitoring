@push('simple-stylesheets')
    <link rel="stylesheet" href="{{ asset('css/simple-datatables/style.css') }}">
@endpush

@foreach ($servers as $server)
    <tr class=@if($server['online']) "table-success"> @else "table-dark"> @endif
        <td>{{ $server['id'] }}</td>
        <td>{{ $server->game['name'] }}</td>
        <td>{{ $server['name'] }}</td>
        <td>{{ $server['ip'] . ":" }}{{ $server['port'] }}</td>
        <td>{{ $server['players'] }} | {{ $server['max_players'] }}</td>
        <td>{{ $server['map'] }}</td>
        <td>
            <span class=@if($server['online']) "badge bg-success">Active @else "badge bg-danger">Inactive @endif
            </span>
        </td>
    </tr>
@endforeach

@push('simple-script')
    <script src="{{ asset('js/vendor/simple-datatables.js') }}"></script>
    <script>
        var table = new simpleDatatables.DataTable("table");
    </script>
@endpush
