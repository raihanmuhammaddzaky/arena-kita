<?php

namespace Tests\Unit\Models;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function payments_table_has_expected_columns()
    {
        $this->assertTrue(
          Schema::hasColumns('payments', [
            'id', 'booking_id', 'proof_image', 'status'
        ]));
    }

    /** @test */
    public function a_payment_belongs_to_booking()
    {
        $payment = new Payment();
        $this->assertTrue(method_exists($payment, 'booking'));
    }

    /** @test */
    public function it_has_proof_image_url_attribute()
    {
        $payment = new Payment();
        $payment->proof_image = 'test.jpg';
        $this->assertStringContainsString('storage/test.jpg', $payment->proof_image_url);

        $payment2 = new Payment();
        $payment2->proof_image = 'https://example.com/test.jpg';
        $this->assertEquals('https://example.com/test.jpg', $payment2->proof_image_url);
    }
}
