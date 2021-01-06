@extends('layouts.voler')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3>All Servers</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr class="table-light">
                    <th>id</th>
                    <th>Game</th>
                    <th>Name</th>
                    <th>IP:Port</th>
                    <th>Players</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @include('pages.table', ['servers' => $servers])
                </tbody>
            </table>
        </div>
    </div>

@endsection
