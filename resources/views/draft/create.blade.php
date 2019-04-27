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

                    <form action="{{ route('draft.currencies') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        Valor a sacar: <input type="text" name="value" id="value" value="{{ old('value') }}">
                        <br><button type="submit">Sacar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
