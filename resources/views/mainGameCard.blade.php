<div class="card">
    <div class="card-content">
        <img class="card-img-top img-fluid" src="{{ asset('images/maincard.png') }}" alt="Card image cap">
        <div class="card-body">
            <h3 class="card-title text-center mb-3">Monitoring Game Servers</h3>
            <hr>
            <div class="container">
                <div class="row games-list">
                    @foreach($games as $game)
                        <div class="col-6 col-md-2">
                            <div class="item text-center text-xs mt-2">
                                <a href="{{ route('game.page', ['slug' => $game['url']]) }}"
                                   title="Серверы {{ $game['name'] }}">
                                    <img src="{{ $game['icon'] }}" title="{{ $game['name'] }}"
                                         alt="{{ $game['name'] }}">
                                    <p class="font-semibold">{{ $game['name'] }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
