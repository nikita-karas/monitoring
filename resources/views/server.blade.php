@extends('layouts.voler')
@section('content')

            <div class="card col-md-7 col-sm-12 mx-auto">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-flex">
                        Add server
                    </h4>
                </div>
                <div class="card-body mt-3">
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
                                            @foreach($data->get() as $game)
                                                <option value="{{ $game['id'] }}">{{ $game['name'] }}</option>
                                            @endforeach
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

@endsection
