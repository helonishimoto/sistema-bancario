<?php

namespace App\Http\Controllers;

use Auth;
use App\Currency;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function create()
    {
    	return view('draft.create');
    }

    public function store(Request $request)
    {
    	/**
    	saque de 500
    	{
			100 => 2,
			50 => 5,
			20 => 2,
			10 => 1
    	}
    	ou
    	{
			100 => 5
    	}
    	*/
    }

    public function checkCurrencies(Request $request)
    {
    	$currency = Currency::all();

    	$value = $request->value;

    	if ($value > Auth::user()->balance) {
    		// retornar resposta de erro de saldo insuficiente
    	}

    	if ($value < $currency->min('currency')) {
    		// retornar resposta de erro de valor inválido, tem que ser maior ou igual a R$ 2.
    	}

    	//
    }
}
