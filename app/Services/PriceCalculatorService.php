<?php

namespace App\Services;

class PriceCalculatorService
{
    const TYPE_A_BASE_PRICE = 99900;
    const TYPE_B_BASE_PRICE = 49900;

    /**
     * Calculate the final price for a given item type and quantity.
     *
     * The day is auto-detected externally (not a user input per spec:
     * "Input = tipe barang, jumlah barang"), but accepted as a parameter
     * here so the service remains fully testable.
     *
     * Discount rules:
     *   Type A (base Rp 99.900):
     *     - qty > 50  → 5% discount
     *     - Monday or Thursday → additional 10% discount
     *   Type B (base Rp 49.900):
     *     - qty > 100 → 10% discount
     *     - Friday    → additional 5% discount
     *
     * @param  string $type     'A' or 'B'
     * @param  int    $quantity number of items
     * @param  string $day      English day name e.g. 'Monday' (from now()->format('l'))
     * @return array
     */
    public function calculate(string $type, int $quantity, string $day): array
    {
        $type = strtoupper($type);

        if ($type === 'A') {
            $basePrice    = self::TYPE_A_BASE_PRICE;
            $qtyDiscount  = ($quantity > 50) ? 5 : 0;
            $dayDiscount  = (in_array($day, ['Monday', 'Thursday'])) ? 10 : 0;
        } else {
            $basePrice    = self::TYPE_B_BASE_PRICE;
            $qtyDiscount  = ($quantity > 100) ? 10 : 0;
            $dayDiscount  = ($day === 'Friday') ? 5 : 0;
        }

        $totalDiscountPercent = $qtyDiscount + $dayDiscount;
        $pricePerUnit         = $basePrice * (1 - $totalDiscountPercent / 100);
        $finalPrice           = $pricePerUnit * $quantity;
        $discountAmount       = ($basePrice * $quantity) - $finalPrice;

        return [
            'type'                  => $type,
            'quantity'              => $quantity,
            'day'                   => $day,
            'base_price'            => $basePrice,
            'qty_discount_percent'  => $qtyDiscount,
            'day_discount_percent'  => $dayDiscount,
            'total_discount_percent'=> $totalDiscountPercent,
            'discount_amount'       => $discountAmount,
            'final_price'           => $finalPrice,
        ];
    }
}
