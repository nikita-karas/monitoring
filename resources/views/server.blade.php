<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add server</title>
    <link rel="stylesheet" href="{{ mix('css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix('css/app.min.css') }}">
</head>

<body>
<div id="auth">

    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <nav class="navbar">
                                <div class="container-fluid">
                                    <h2 class="card-text">Add server</h2>
                                    <div>
                                        <div class="avatar mr-1">
                                            <img src="{{ $user['avatar_small'] }}">
                                        </div>
                                        <div class="d-none d-md-block d-lg-inline-block">
                                            <h5>Hi, <a
                                                    href="https://steamcommunity.com/profiles/{{$user['steam_id']}}">{{ $user['name'] }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                            <div class="text-center mb-5">
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
                            <form class="form form-vertical" method="post" action="{{ route('server.store') }}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div>
                                            <fieldset class="form-group">
                                                <label for="game">Game</label>
                                                <select class="form-select" id="game" name="game">
                                                    <option>Counter-Strike 1.6</option>
                                                    <option>Team Fortress 2</option>
                                                    <option>Left 4 Dead 2</option>
                                                    <option>Counter-Strike: Global Offensive</option>
                                                    <option>Rag Doll Kung Fu</option>
                                                    <option>The Ship</option>
                                                    <option>Garry's Mod</option>
                                                    <option>Nuclear Dawn</option>
                                                    <option>Dino D-Day</option>
                                                    <option>Arma 3</option>
                                                    <option>Call of Duty: Modern Warfare 3</option>
                                                    <option>Starbound</option>
                                                    <option>Space Engineers</option>
                                                    <option>7 Days to Die</option>
                                                    <option>Rust</option>
                                                    <option>Quake Live</option>
                                                    <option>ARK: Survival Evolved</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="ip">IP</label>
                                                <input type="text" class="form-control" id="ip" name="ip">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="port">PORT</label>
                                                <input type="text" class="form-control" id="port" name="port">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="{{ mix('js/vendor/feather-icons.min.js') }}"></script>
<script src="{{ mix('js/app.min.js') }}"></script>
<script src="{{ mix('js/main.min.js') }}"></script>
</body>

</html>
