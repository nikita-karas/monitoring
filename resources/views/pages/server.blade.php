@extends('layouts.voler')
@section('content')
    <div class="row mb-2">

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $server->name }}</h4>
                </div>
                <div class="card-body">
                    <p>IP:PORT: {{ $server->ip }}:{{ $server->port }}</p>
                    <p>Map: {{ $server->map }}</p>
                    <p>Players: {{ $server->players }}/{{ $server->max_players }}</p>
                    <p>Updated: {{ $time }} minutes ago</p>
                    @if(isset($server->user->name))
                        <p>Owner: {{ $server->user->name }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card ">
                <div class="card-header">
                    <h4>Player List</h4>
                </div>
                <div class="card-body" style="position: relative;">
                    @if(!$server->online)
                        <div class="alert alert-warning">
                            <h4 class="alert-heading">Fail</h4>
                            <p>No connection to server</p>
                        </div>
                    @elseif(isset($players))
                        @foreach($players as $player)
                            <ul>
                                <li>{{ $player['Name'] }}</li>
                            </ul>
                        @endforeach
                    @else
                        <p>Server is empty</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
