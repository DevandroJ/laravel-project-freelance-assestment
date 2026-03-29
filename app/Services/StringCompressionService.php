<?php

namespace App\Services;

class StringCompressionService
{
    /**
     * Compress a string by counting total frequency of each character,
     * then output characters sorted alphabetically with their counts.
     * Characters with count = 1 are shown without a number.
     *
     * Example: "aaabbcccddeddbzaa" → "a5b3c3d4ez"
     * Breakdown: a=5, b=3, c=3, d=4, e=1, z=1 → sorted alphabetically
     */
    public function compress(string $input): string
    {
        if ($input === '') {
            return '';
        }

        // Step 1: Count frequency of each character using a loop
        $frequency = [];
        $length = strlen($input);

        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];
            if (isset($frequency[$char])) {
                $frequency[$char]++;
            } else {
                $frequency[$char] = 1;
            }
        }

        // Step 2: Sort characters alphabetically by key
        ksort($frequency);

        // Step 3: Build the output string
        $result = '';
        foreach ($frequency as $char => $count) {
            $result .= $char;
            if ($count > 1) {
                $result .= $count;
            }
        }

        return $result;
    }
}
