<?php

namespace App\Http\Controllers;

use App\Services\ArraySortService;

class Question2Controller extends Controller
{
    // The hardcoded array from the problem statement
    const ARRAY_INPUT = [9, 3, 7, 8, 2, 6, 1, 4, 10, 2, 2, 3];

    public function __construct(private ArraySortService $service) {}

    public function index()
    {
        $input  = self::ARRAY_INPUT;
        $sorted = $this->service->sort($input);

        return view('question2.index', compact('input', 'sorted'));
    }
}
