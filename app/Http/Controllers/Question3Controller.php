<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PriceCalculatorService;

class Question3Controller extends Controller
{
    const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    public function __construct(private PriceCalculatorService $service) {}

    public function index()
    {
        $actualDay   = now()->format('l');
        $selectedDay = $actualDay;
        return view('question3.index', compact('actualDay', 'selectedDay'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'type'     => ['required', 'in:A,B'],
            'quantity' => ['required', 'integer', 'min:1'],
            'day'      => ['required', 'in:' . implode(',', self::DAYS)],
        ]);

        $actualDay   = now()->format('l');
        $selectedDay = $request->input('day');

        $result = $this->service->calculate(
            $request->input('type'),
            (int) $request->input('quantity'),
            $selectedDay
        );

        return view('question3.index', compact('actualDay', 'selectedDay', 'result'));
    }
}
