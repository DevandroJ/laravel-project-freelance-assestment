<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PriceCalculatorService;

class PriceCalculatorServiceTest extends TestCase
{
    private PriceCalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PriceCalculatorService();
    }

    // -----------------------------------------------------------------------
    // Type A (base Rp 99.900)
    // -----------------------------------------------------------------------

    /** No discounts: qty <= 50, neutral day */
    public function test_type_a_no_discount(): void
    {
        $result = $this->service->calculate('A', 10, 'Wednesday');

        $this->assertSame(0, $result['qty_discount_percent']);
        $this->assertSame(0, $result['day_discount_percent']);
        $this->assertSame(0, $result['total_discount_percent']);
        $this->assertEquals(0, $result['discount_amount']);
        $this->assertSame(99900 * 10, (int) $result['final_price']);
    }

    /** Quantity discount only: qty > 50, neutral day */
    public function test_type_a_quantity_discount_only(): void
    {
        $result = $this->service->calculate('A', 51, 'Wednesday');

        $this->assertSame(5, $result['qty_discount_percent']);
        $this->assertSame(0, $result['day_discount_percent']);
        $this->assertSame(5, $result['total_discount_percent']);
        $expected = 99900 * 0.95 * 51;
        $this->assertEqualsWithDelta($expected, $result['final_price'], 0.01);
    }

    /** Day discount only on Monday: qty <= 50 */
    public function test_type_a_day_discount_monday(): void
    {
        $result = $this->service->calculate('A', 10, 'Monday');

        $this->assertSame(0, $result['qty_discount_percent']);
        $this->assertSame(10, $result['day_discount_percent']);
        $expected = 99900 * 0.90 * 10;
        $this->assertEqualsWithDelta($expected, $result['final_price'], 0.01);
    }

    /** Day discount only on Thursday: qty <= 50 */
    public function test_type_a_day_discount_thursday(): void
    {
        $result = $this->service->calculate('A', 10, 'Thursday');

        $this->assertSame(10, $result['day_discount_percent']);
        $expected = 99900 * 0.90 * 10;
        $this->assertEqualsWithDelta($expected, $result['final_price'], 0.01);
    }

    /** Both discounts: qty > 50 AND Thursday → total 15% off */
    public function test_type_a_both_discounts_thursday(): void
    {
        $result = $this->service->calculate('A', 51, 'Thursday');

        $this->assertSame(5, $result['qty_discount_percent']);
        $this->assertSame(10, $result['day_discount_percent']);
        $this->assertSame(15, $result['total_discount_percent']);
        $expected = 99900 * 0.85 * 51;
        $this->assertEqualsWithDelta($expected, $result['final_price'], 0.01);
    }

    /** Boundary: qty = 50 (NOT > 50) → NO quantity discount */
    public function test_type_a_boundary_qty_50_no_qty_discount(): void
    {
        $result = $this->service->calculate('A', 50, 'Wednesday');

        $this->assertSame(0, $result['qty_discount_percent'],
            'qty=50 should NOT trigger the >50 discount');
    }

    /** Wrong day (Tuesday) → no day discount for Type A */
    public function test_type_a_tuesday_gives_no_day_discount(): void
    {
        $result = $this->service->calculate('A', 10, 'Tuesday');

        $this->assertSame(0, $result['day_discount_percent'],
            'Tuesday is not Monday/Thursday — no day discount for Type A');
    }

    // -----------------------------------------------------------------------
    // Type B (base Rp 49.900)
    // -----------------------------------------------------------------------

    /** No discounts: qty <= 100, neutral day */
    public function test_type_b_no_discount(): void
    {
        $result = $this->service->calculate('B', 50, 'Wednesday');

        $this->assertSame(0, $result['qty_discount_percent']);
        $this->assertSame(0, $result['day_discount_percent']);
        $this->assertSame(0, $result['total_discount_percent']);
        $this->assertSame(49900 * 50, (int) $result['final_price']);
    }

    /** Quantity discount only: qty > 100, neutral day */
    public function test_type_b_quantity_discount_only(): void
    {
        $result = $this->service->calculate('B', 101, 'Wednesday');

        $this->assertSame(10, $result['qty_discount_percent']);
        $this->assertSame(0, $result['day_discount_percent']);
        $expected = 49900 * 0.90 * 101;
        $this->assertEqualsWithDelta($expected, $result['final_price'], 0.01);
    }

    /** Day discount only on Friday: qty <= 100 */
    public function test_type_b_day_discount_friday(): void
    {
        $result = $this->service->calculate('B', 50, 'Friday');

        $this->assertSame(0, $result['qty_discount_percent']);
        $this->assertSame(5, $result['day_discount_percent']);
        $expected = 49900 * 0.95 * 50;
        $this->assertEqualsWithDelta($expected, $result['final_price'], 0.01);
    }

    /** Both discounts: qty > 100 AND Friday → total 15% off */
    public function test_type_b_both_discounts_friday(): void
    {
        $result = $this->service->calculate('B', 101, 'Friday');

        $this->assertSame(10, $result['qty_discount_percent']);
        $this->assertSame(5, $result['day_discount_percent']);
        $this->assertSame(15, $result['total_discount_percent']);
        $expected = 49900 * 0.85 * 101;
        $this->assertEqualsWithDelta($expected, $result['final_price'], 0.01);
    }

    /** Boundary: qty = 100 (NOT > 100) → NO quantity discount */
    public function test_type_b_boundary_qty_100_no_qty_discount(): void
    {
        $result = $this->service->calculate('B', 100, 'Wednesday');

        $this->assertSame(0, $result['qty_discount_percent'],
            'qty=100 should NOT trigger the >100 discount');
    }

    /** Wrong day (Thursday) → no day discount for Type B */
    public function test_type_b_thursday_gives_no_day_discount(): void
    {
        $result = $this->service->calculate('B', 50, 'Thursday');

        $this->assertSame(0, $result['day_discount_percent'],
            'Thursday is not Friday — no day discount for Type B');
    }
}
