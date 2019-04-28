@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bem-vindo, {{ $user->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Seu saldo é de R$ {{ $user->balance }}.

                   <br> <a href="{{ route('draft.create') }}">Saque</a> 
                   <br> <a href="{{ route('deposit.create') }}">Depósito</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
