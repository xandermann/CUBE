<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;

class InvoiceController extends Controller
{

    /**
    * @param $id
    * @return \Illuminate\Http\Response
    */
    public function index($id) {
        $dompdf = new Dompdf();

        $filename = "GoodFood_Invoice_$id.pdf";
        $dompdf->loadHtml(view('invoice_pdf', compact('id')));

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();


        return response($dompdf->stream($filename, ["Attachment" => false]))
        ->header('Content-Type', 'application/pdf');

    }
}