@foreach ($servers as $server)
    <tr class=@if($server['online']) "table-success"> @else "table-dark"> @endif
        <td>{{ $server['id'] }}</td>
        <td>{{ $server->game['name'] }}</td>
        <td>{{ $server['name'] }}</td>
        <td>{{ $server['ip'] . ":" }}{{ $server['port'] }}</td>
        <td>{{ $server['players'] }} | {{ $server['max_players'] }}</td>
        <td>
            <span class=@if($server['online']) "badge bg-success">Active @else "badge bg-danger">Inactive @endif
            </span>
        </td>
    </tr>
@endforeach
