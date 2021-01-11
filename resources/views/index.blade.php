@extends('layouts.voler')
@section('content')

    @include('mainGameCard')

    <div class="card">
        <div class="card-header">
            <h3>All Servers</h3>
        </div>
        <div class="card-body">

            <form method="get" action="{{ route('home.search') }}">
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
                    <tbody class="text-xs">
                    @include('table', ['servers' => $servers])
                    </tbody>
                </table>
            </div>

            <div class="overflow-auto d-flex justify-content-center">
                {{ $servers->links() }}
            </div>

        </div>
    </div>

@endsection
