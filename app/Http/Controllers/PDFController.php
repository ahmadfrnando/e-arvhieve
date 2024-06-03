<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function cetaksuratmasuk(Request $request){

        $no = 1;
        // $suratMasuk = SuratMasuk::all();
        $createdFrom = $request->query('created_from');
        $createdUntil = $request->query('created_until');
        // dd($createdFrom, $createdUntil);
        $suratMasuk = SuratMasuk::whereBetween('created_at', [$createdFrom, $createdUntil])->get();

        $pdf = PDF::loadView('suratmasukpdf', compact('suratMasuk', 'no', 'createdFrom', 'createdUntil'));

        return $pdf->download('Laporan-Surat-Masuk.pdf');
    }
    
    public function cetaksuratkeluar(Request $request){
        // $suratKeluar = SuratKeluar::all();
        $createdFrom = $request->query('created_from');
        $createdUntil = $request->query('created_until');
        // dd($createdFrom, $createdUntil);
        $suratKeluar = SuratKeluar::whereBetween('created_at', [$createdFrom, $createdUntil])->get();

        $no = 1;
        $pdf = PDF::loadView('suratkeluarpdf', compact('createdFrom', 'createdUntil', 'no', 'suratKeluar'));

        return $pdf->download('Laporan-Surat-Keluar.pdf');
    }
}