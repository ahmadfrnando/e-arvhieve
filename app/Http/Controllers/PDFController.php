<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function cetaksuratmasuk(){

        $no = 1;
        $suratMasuk = SuratMasuk::all();

        $pdf = PDF::loadView('suratmasukpdf', compact('suratMasuk', 'no'));

        return $pdf->download('Laporan-Surat-Masuk.pdf');
    }
    
    public function cetaksuratkeluar(){
        $suratKeluar = SuratKeluar::all();

        $no = 1;
        $pdf = PDF::loadView('suratkeluarpdf', compact('suratKeluar', 'no'));

        return $pdf->download('Laporan-Surat-Keluar.pdf');
    }
}