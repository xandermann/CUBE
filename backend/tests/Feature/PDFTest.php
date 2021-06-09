<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class PDFTest extends TestCase
{
    /**
     * @test
     */
    public function index() {
        // Due to a bug, the PDF is printed in the console
        // To avoid this, we have to put the result in an another buffer

        ob_start();
        $response = $this->get("http://localhost/pdf/invoices/1");
        ob_clean();
        ob_end_flush();

        $response->assertStatus(200);
    }
}
