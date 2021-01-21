@extends('layouts.voler')
@section('content')
    <script>

    </script>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Your servers</h4>
            <button type="button" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="@mdo">Token
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Your token</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="message-text"
                                           value="{{ $user['api_token'] }}">
                                    <input type="button" class="mt-2 float-end" data-feather="copy"
                                           onclick="myFunction()">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            @if($diff >= 1)
                                <form method="post" id="change-token-form" action="{{ route('token.change') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-light" id="change-token" data-bs-dismiss="modal" name="id" value="{{ $user->id }}">
                                        Update
                                    </button>
                                </form>
                            @endif
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success text-center">
                <p>{{ session('status') }}</p>
            </div>
        @endif
        <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <table class="table mb-0" id="table1">
                    <thead>
                    <tr>
                        <th>Date added</th>
                        <th>Game</th>
                        <th>Name</th>
                        <th>IP:Port</th>
                        <th>Players</th>
                        <th>Map</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody class="text-xs text-lg-center">
                    @foreach($user->servers as $server)
                        <tr class=@if($server['online']) "table-success"> @else "table-dark"> @endif
                            <td>{{ $server->created_at->format('d/m/Y H:i:s') }}</td>
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
                            <td><span class=@if($server['online']) "badge bg-success">Active @else "badge
                                    bg-danger">Inactive @endif</span></td>
                            <td class="text-lg-center">
                                <form method="post" id="delete-form-{{ $server->id }}"
                                      action="{{ route('server.delete') }}">
                                    @csrf
                                    <button type="submit" name="delete" id="delete-server-{{ $server->id }}"
                                            value="{{ $server->id }}"></button>
                                    </br>
                                    <label for="delete-server-{{ $server->id }}">Delete</label>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
