<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\invoice;

class InvoiceController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getjson()
    {
        $inv=invoice::with('invoicedetail')->get();
        return \json_decode($inv);
    }

}
