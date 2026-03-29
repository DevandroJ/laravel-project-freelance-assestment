<?php

namespace App\Services;

class ArraySortService
{
    /**
     * Sort an array from smallest to largest using Insertion Sort.
     *
     * Insertion Sort is chosen over Bubble Sort because:
     * - Same O(1) extra memory (in-place)
     * - O(n) best case when array is nearly sorted (Bubble Sort is O(n²))
     * - Fewer element movements (shifts instead of repeated swaps)
     *
     * Uses only loops and conditions — no built-in sort functions.
     *
     * Example: [9,3,7,8,2,6,1,4,10,2,2,3] → [1,2,2,2,3,3,4,6,7,8,9,10]
     */
    public function sort(array $input): array
    {
        $n = count($input);

        for ($i = 1; $i < $n; $i++) {
            $key = $input[$i];
            $j = $i - 1;

            // Shift elements that are greater than $key one position to the right
            while ($j >= 0 && $input[$j] > $key) {
                $input[$j + 1] = $input[$j];
                $j--;
            }

            // Place $key in its correct sorted position
            $input[$j + 1] = $key;
        }

        return $input;
    }
}
