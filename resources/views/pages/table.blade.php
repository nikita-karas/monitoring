@foreach ($servers as $server)
    <tr class=@if($server['online']) "table-success"> @else "table-dark"> @endif
        <td><img src="{{ $server->game['icon'] }}"></td>
        <td>
            <a href="{{ route('server.page', ['slug' => $server->game['url'], 'id' => $server['id']]) }}">{{ $server['name'] }}</a>
        </td>
        <td>{{ $server['ip'] . ":" }}{{ $server['port'] }}</td>
        @if($server['online'])
            <td>{{ $server['players'] }}/{{ $server['max_players'] }}</td>
        @else
            <td></td>
        @endif
        <td>{{ $server['map'] }}</td>
        <td>
            <span class=@if($server['online']) "badge bg-success">Active @else "badge bg-danger">Inactive @endif
            </span>
        </td>
    </tr>
@endforeach
