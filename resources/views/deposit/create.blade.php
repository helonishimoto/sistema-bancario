@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Depósito</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="aler alert-warning" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    
                    <form action="{{ route('deposit.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        Agência: <input type="text" name="agency"><br><br>
                        Conta: <input type="text" name="account"><br><br>
                        Valor: <input type="text" name="value" required id="value" value="{{ old('value') }}"><br><br>
                        <button type="submit">Depositar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection