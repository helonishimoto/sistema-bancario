@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Seu saldo é de R$ {{ $user->balance }}.

                   <br> <a href="{{ route('draft.create') }}">Clique aqui</a> para sacar.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
