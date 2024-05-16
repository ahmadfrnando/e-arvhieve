<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadsuratmasuk($id)
    {
        // Temukan surat masuk berdasarkan ID
        $suratMasuk = SuratMasuk::findOrFail($id);

        // Ambil path file dari surat masuk
        $filePath = $suratMasuk->file;

        // Pastikan file ada
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        // Buat header untuk response
        $headers = [
            'Content-Type' => 'application/pdf', // sesuaikan dengan tipe file
        ];

        // Return response dengan file untuk diunduh
        return response()->stream(function () use ($filePath)
            {
                $stream = Storage::disk('public')->readStream($filePath);
                fpassthru($stream);
                fclose($stream);
            }, 200, $headers);
        }
    public function downloadsuratkeluar($id)
    {
        // Temukan surat masuk berdasarkan ID
        $suratKeluar = SuratKeluar::findOrFail($id);

        // Ambil path file dari surat masuk
        $filePath = $suratKeluar->file;

        // Pastikan file ada
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        // Buat header untuk response
        $headers = [
            'Content-Type' => 'application/pdf', // sesuaikan dengan tipe file
        ];

        // Return response dengan file untuk diunduh
        return response()->stream(function () use ($filePath)
            {
                $stream = Storage::disk('public')->readStream($filePath);
                fpassthru($stream);
                fclose($stream);
            }, 200, $headers);
        }
    }