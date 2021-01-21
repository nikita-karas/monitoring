<div class="card">
    <div class="card-header">
        <h3>{{ $title }}</h3>
    </div>
    <div class="card-body">

        <form method="get" action=@if(isset($slug)) "{{ route('game.search', ['slug' => $slug]) }}"> @else "{{ route('home.search') }}"> @endif
            <div class="form-group row">
                <div class="col">
                    <input type="text" class="form-control" name="s" placeholder="Search...">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="table-light">
                    <th>Game</th>
                    <th>Name</th>
                    <th>IP:Port</th>
                    <th>Players</th>
                    <th>Map</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody class="text-xs text-lg-center">
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

        <div class="overflow-auto d-flex justify-content-center">
            @if(isset($search))
                {{ $servers->appends(['s' => $search])->links() }}
            @else
                {{ $servers->links() }}
            @endif
        </div>

    </div>
</div>
