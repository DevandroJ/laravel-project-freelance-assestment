<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PriceCalculatorService;

class Question3Controller extends Controller
{
    public function __construct(private PriceCalculatorService $service) {}

    public function index()
    {
        $today = now()->format('l'); // e.g. "Monday"
        return view('question3.index', compact('today'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'type'     => ['required', 'in:A,B'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $today  = now()->format('l');
        $result = $this->service->calculate(
            $request->input('type'),
            (int) $request->input('quantity'),
            $today
        );

        return view('question3.index', compact('today', 'result'));
    }
}
