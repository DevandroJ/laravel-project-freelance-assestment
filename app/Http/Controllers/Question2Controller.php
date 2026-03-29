<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function process(Request $request)
    {
        $request->validate([
            'custom_array' => ['required', 'string', 'regex:/^-?\d+(\s*,\s*-?\d+)*$/'],
        ], [
            'custom_array.regex' => 'Input must be comma-separated integers only. Negative numbers are allowed. Example: 5, 2, -3, 1, 8',
        ]);

        $customInput  = array_map('intval', array_map('trim', explode(',', $request->input('custom_array'))));
        $customSorted = $this->service->sort($customInput);

        $input  = self::ARRAY_INPUT;
        $sorted = $this->service->sort($input);

        return view('question2.index', compact('input', 'sorted', 'customInput', 'customSorted'));
    }
}
