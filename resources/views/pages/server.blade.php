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
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card ">
                <div class="card-header">
                    <h4>Player List</h4>
                </div>
                <div class="card-body" style="position: relative;">
                    @if($serverPlayers === 'Server connection error')
                        <div class="alert alert-danger">
                            <h4 class="alert-heading">Fail</h4>
                            <p>{{ $serverPlayers }}</p>
                        </div>
                    @else
                        @foreach($serverPlayers as $player)
                            <ul>
                                @if(!empty($player['Name']))
                                    <li>{{ $player['Name'] }}</li>
                                @endif
                            </ul>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
