<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ArraySortService;

class ArraySortServiceTest extends TestCase
{
    private ArraySortService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ArraySortService();
    }

    /** The exact array from the problem statement */
    public function test_given_example(): void
    {
        $input    = [9, 3, 7, 8, 2, 6, 1, 4, 10, 2, 2, 3];
        $expected = [1, 2, 2, 2, 3, 3, 4, 6, 7, 8, 9, 10];
        $this->assertSame($expected, $this->service->sort($input));
    }

    /** Already sorted array should be unchanged */
    public function test_already_sorted(): void
    {
        $this->assertSame([1, 2, 3], $this->service->sort([1, 2, 3]));
    }

    /** Reverse-sorted array */
    public function test_reverse_sorted(): void
    {
        $this->assertSame([1, 2, 3], $this->service->sort([3, 2, 1]));
    }

    /** Single element array */
    public function test_single_element(): void
    {
        $this->assertSame([5], $this->service->sort([5]));
    }

    /** Array with duplicate values */
    public function test_with_duplicates(): void
    {
        $this->assertSame([1, 1, 2, 3], $this->service->sort([3, 1, 2, 1]));
    }

    /** All elements are the same */
    public function test_all_same_elements(): void
    {
        $this->assertSame([3, 3, 3], $this->service->sort([3, 3, 3]));
    }

    /** Two-element unsorted array */
    public function test_two_elements_unsorted(): void
    {
        $this->assertSame([1, 2], $this->service->sort([2, 1]));
    }
}
