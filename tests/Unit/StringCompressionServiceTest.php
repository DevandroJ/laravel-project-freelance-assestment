<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\StringCompressionService;

class StringCompressionServiceTest extends TestCase
{
    private StringCompressionService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new StringCompressionService();
    }

    /** The exact example from the problem statement */
    public function test_given_example(): void
    {
        // a=5, b=3, c=3, d=4, e=1, z=1 — sorted alphabetically
        $this->assertSame('a5b3c3d4ez', $this->service->compress('aaabbcccddeddbzaa'));
    }

    /** All characters appear once — no numbers in output */
    public function test_all_unique_chars_show_no_numbers(): void
    {
        $this->assertSame('abcde', $this->service->compress('abcde'));
    }

    /** Empty string returns empty string */
    public function test_empty_string(): void
    {
        $this->assertSame('', $this->service->compress(''));
    }

    /** Single character */
    public function test_single_char(): void
    {
        $this->assertSame('z', $this->service->compress('z'));
    }

    /** All same character */
    public function test_all_same_char(): void
    {
        $this->assertSame('a4', $this->service->compress('aaaa'));
    }

    /** Two same characters */
    public function test_two_same_chars(): void
    {
        $this->assertSame('a2', $this->service->compress('aa'));
    }

    /** Input not in alphabetical order — output must be alphabetically sorted */
    public function test_unsorted_input_produces_alphabetical_output(): void
    {
        // 'ba' → a appears before b alphabetically
        $this->assertSame('ab', $this->service->compress('ba'));
    }
}
