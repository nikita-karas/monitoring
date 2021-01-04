@extends('layouts.voler')
@section('content')

        <div class="card">
            <div class="card-header">
                <h3>All servers</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr class="table-light">
                        <th>id</th>
                        <th>Game</th>
                        <th>Name</th>
                        <th>IP:Port</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($servers as $server)
                        <tr class=@if($server['online'])"table-success"> @else "table-dark"> @endif
                            <td>{{ $server['id'] }}</td>
                            <td>{{ $server->game['name'] }}</td>
                            <td>{{ $server['name'] }}</td>
                            <td>{{ $server['ip'] . ":" }}{{ $server['port'] }}</td>
                            <td>
                                <span class=@if($server['online'])"badge bg-success">Active @else "badge bg-danger">Inactive @endif </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    <script src="{{ asset('js/vendor/simple-datatables.js') }}"></script>
    <script>
        var table = new simpleDatatables.DataTable("table");
    </script>

@endsection
