@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Saque</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('draft.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="value" value="{{ $value }}">

                       @foreach($options as $k => $option)
                       <label for="option-{{ $k }}">
                          <input type="radio" required name="withdraw_money" id="option-{{ $k }}" value="{{ json_encode($option) }}">
                           {{ $visual[$k] }}
                       </label><br>
                       @endforeach
                        <br><button type="submit">Sacar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection