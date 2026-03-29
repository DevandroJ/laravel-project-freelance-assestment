<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StringCompressionService;

class Question1Controller extends Controller
{
    public function __construct(private StringCompressionService $service) {}

    public function index()
    {
        return view('question1.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'input_string' => ['required', 'string', 'max:1000'],
        ]);

        $input  = $request->input('input_string');
        $output = $this->service->compress($input);

        return view('question1.index', compact('input', 'output'));
    }
}
