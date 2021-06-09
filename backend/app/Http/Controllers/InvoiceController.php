<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Dompdf\Dompdf;

class InvoiceController extends Controller
{

    /**
    * @param $id
    * @return \Illuminate\Http\Response
    */
    public function index($id) {

        $order = Order::where('id', $id)->with('dishes')->with('menus')->with('user')->firstOrFail();

        $dompdf = new Dompdf();

        $filename = "GoodFood_Invoice_$id.pdf";
        $dompdf->loadHtml(view('invoice_pdf', compact('order')));

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return response($dompdf->stream($filename, ["Attachment" => false]))
        ->header('Content-Type', 'application/pdf');

    }
}