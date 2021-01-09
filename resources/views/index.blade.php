@extends('layouts.voler')
@section('content')

    <style>
        .item {
            text-align: center;
            font-size: .9em;
            line-height: 1.2em;
            padding-bottom: 1rem;
        }

        .item a span {
            display: block;
            margin-top: .35rem;
        }
    </style>

    <div class="card">
        <div class="card-content">
            <img class="card-img-top img-fluid" src="https://i.imgur.com/jCUWTDN.png" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title text-center mb-3">Monitoring Game Servers</h3>
                <hr>
                <div class="container">
                    <div class="row games-list">
                        @foreach($games as $game)
                            <div class="col-6 col-md-2">
                                <div class="item">
                                    <a href="{{ route('game.page', ['slug' => $game['url']]) }}"
                                       title="Серверы {{ $game['name'] }}">
                                        <img src="{{ $game['icon'] }}" title="{{ $game['name'] }}"
                                             alt="{{ $game['name'] }}">
                                        <span class="font-semibold">{{ $game['name'] }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>All Servers</h3>
        </div>
        <div class="card-body">
            <form method="get" action="{{ route('search') }}">
                <div class="form-group row">
                    <div class="col">
                        <input type="text" class="form-control" id="s" name="s" placeholder="Search...">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                    </div>
                </div>

            </form>
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
                <tbody class="text-xs">
                @include('pages.table', ['servers' => $servers])
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $servers->links() }}
            </div>
        </div>
    </div>

@endsection
