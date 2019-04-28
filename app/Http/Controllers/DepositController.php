<?php

namespace App\Http\Controllers;

use App\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
    	return view('deposit.create');
    }

    public function store(Request $request)
    {
    	
    }
}
