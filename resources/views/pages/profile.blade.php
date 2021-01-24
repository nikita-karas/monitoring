@extends('layouts.voler')
@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Your servers</h4>
            <button type="button" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#modal">Token
            </button>

            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Your token</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="token-text"
                                           value="{{ $user['api_token'] }}">
                                    <input type="button" class="mt-2 float-end" data-feather="copy"
                                           onclick="myFunction()">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <form method="post"
                                  action="{{ route('token.change') }}">
                                @csrf
                                <button type="submit" class="btn btn-light" name="id">
                                    Update
                                </button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success text-center">
                <p>{{ session('status') }}</p>
            </div>
        @endif
        <div class="card-body px-0 pb-0">
            @if($user->servers[0])
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
                        <tbody class="text-xs text-lg-start">
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
                                <td>
                                    <form method="POST" action="{{ route('server.delete', ['id' => $server['id']]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn icon btn-danger" onclick="return confirm('Are you sure you want to delete the record ?')"
                                                title='Delete'><i data-feather="x"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h4 class="text-center">No servers found....</h4>
            @endif
        </div>

    </div>

    <script>
        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("token-text");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Copied: " + copyText.value);
        }
    </script>

@endsection
