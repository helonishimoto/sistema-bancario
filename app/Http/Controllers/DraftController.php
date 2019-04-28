<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Draft;
use App\Currency;
use App\DraftCurrency;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function create()
    {
        return view('draft.create');
    }

    public function store(Request $request)
    {
        $money = json_decode($request->withdraw_money, true);
        $value = $request->value;

        $transaction = true;

        try {
            DB::transaction(function () use ($money, $value) {
                $user = Auth::user();
                $user->balance = $user->balance - $value;
                $user->save();

                $draft = Draft::create([
                                           'user_id' => $user->id,
                                           'value'   => $value
                                       ]);

                foreach ($money as $k) {
                    $currency = Currency::where('currency', $k['currency'])->first();


                    DraftCurrency::create([
                                              'draft_id'    => $draft->id,
                                              'currency_id' => $currency->id,
                                              'quantity'    => $k['quantity']
                                          ]);

                    $currency->update([
                                          'quantity' => $currency->quantity - $k['quantity']
                                      ]);
                }


            });
        } catch (\Exception $e) {
            $transaction = false;

            $error = $e->getMessage();
        }

        if ($transaction) {
            return redirect()->route('draft.create')
                             ->with('status', 'Saque de R$ ' . $value . ' realizado com sucesso.');
        } else {
            return redirect()->route('draft.create')->withErrors('Erro ao concluir o saque. ' . $error);
        }
    }

    public function checkCurrencies(Request $request)
    {
        $currencies = Currency::where('quantity', '>', 0)->orderBy('currency', 'desc')->get();

        $value = $request->value;

        if ($value > Auth::user()->balance) {
            return back()->withInput()
                         ->withErrors(['error' => 'O valor solicitado é maior do que o disponível em conta.']);
        }

        if ($value < $currencies->min('currency')) {
            return back()->withInput()->withErrors(['error' => 'O valor solicitado deve ser maior ou igual a ' . $currencies->min('currency') . '.']);
        }

        $options = [
            [],
            []
        ];

        $currencies->each(function ($currency) use (&$options, &$value) {
            $this->prepareAmount($currency, $options[0], $value);
        });

        $value = $request->value;

        $currencies->filter(function ($currency) use ($options) {
            return $currency->currency < collect($options[0])->max('currency');
        })->values()->each(function ($currency) use (&$options, &$value) {
            $this->prepareAmount($currency, $options[1], $value);
        });

        $value = $request->value;

        $options = $this->getAvailableOptions($options, $value);

        if (count($options) == 0) {
            return back()->withInput()->withErrors(['error' => 'Não há notas disponíveis para este saque.']);
        }

        $visualOptions = [];

        foreach ($options as $option) {
            $text = '';

            foreach ($option as $opt) {
                $text .= $opt['quantity'] . ' nota' . ($opt['quantity'] == 1 ? '' : 's') . ' de R$ ' . $opt['currency'] . ', ';
            }

            $visualOptions[] = rtrim(trim($text), ',');
        }

        return view('draft.options', [
            'value'   => $value,
            'options' => $options,
            'visual'  => $visualOptions
        ]);
    }

    private function prepareAmount($currency, &$options, &$value)
    {
        if ($value >= $currency->currency) {
            $amount = intdiv($value, $currency->currency);

            if ($amount > $currency->quantity) {
                $value = $value - $currency->currency * $currency->quantity;
            } else {
                $value = $value - $currency->currency * $amount;
            }

            if ($amount > 0) {
                $options[] = [
                    'currency' => $currency->currency,
                    'quantity' => $amount > $currency->quantity ? $currency->quantity : $amount
                ];
            }
        }
    }

    private function getAvailableOptions($options, $value)
    {
        return collect($options)->filter(function ($option) use ($value) {
            $sum = 0;

            foreach ($option as $k => $v) {
                $sum += $v['currency'] * $v['quantity'];
            }

            return $sum == $value;
        })->values()->toArray();
    }
}
