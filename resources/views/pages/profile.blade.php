@extends('layouts.voler')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Your servers</h4>
        </div>
        <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <table class="table mb-0" id="table1">
                    <thead>
                    <tr>
                        <th>Game</th>
                        <th>Name</th>
                        <th>IP:Port</th>
                        <th>Players</th>
                        <th>Map</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($servers as $server)
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
                                <span class=@if($server['online']) "badge bg-success">Active @else "badge bg-danger">Inactive @endif</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
