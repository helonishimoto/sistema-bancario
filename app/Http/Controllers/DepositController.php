<?php

namespace App\Http\Controllers;

use App\User;
use App\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function create() 
    {
    	return view('deposit.create');
    }

    public function store(Request $request)
    {
    	$agency = $request->agency;
    	$account = $request->account;
    	$value = $request->value;
    	$user = User::where('agency', $agency)->where('account', $account)->first();

    	if($user == null)
    	{
    		return back()->withErrors(['Agência e conta não encontrada']);
    	}

        if($user == null)
        {
            return back()->withErrors(['Agência e conta não encontrada']);
        }
        $deposit = Deposit::create([
            'agency' => $user->agency,
            'account' => $user->account,
            'value' => $value
        ]);
        
    	$user->balance = $user->balance + $value;
    	$user->save();

    	return back()->with(['status' => 'Depósito realizado com sucesso']);
    }

}
