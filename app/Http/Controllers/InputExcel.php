<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlternatifModel;
use App\Models\AlternatifSkor;
use App\Models\KriteriaBobotModel;
use Illuminate\Http\Request;
use Kriteriabobot;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class InputExcel extends Controller
{
    public function uploadExcelKriteria(Request $request)
    {
        try {
            $request->validate([
                'excel_file' => 'required|mimes:xlsx,xls', // Make sure the uploaded file is an Excel file
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $file = $request->file('excel_file');

        // Use the Excel facade to import the data
        $data = Excel::toArray([], $file)[0];

        // Remove first and second row from $data
        // The first and second row of an Excel file are headings
        array_shift($data);
        array_shift($data);

        try {
            foreach ($data as $row) {
                KriteriaBobotModel::create([
                    'nama' => $row[0],
                    'tipe' => $row[1],
                    'bobot' => $row[2],
                    'description' => $row[3],
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data Gagal Diupload, Silahkan Cek Apakah Ada Duplikasi Data');
        }

        return redirect('/kriteriabobot')->with('success', 'Data Berhasil Diupload');
    }

    public function downloadExcelTemplateKriteria()
    {
        $template = public_path('excel\template_kriteria.xlsx');
        return response()->download($template, 'template_kriteria.xlsx');
    }

    public function downloadExcelTemplateAlternatif()
    {
        // Ambil data kriteria dari database
        $kriteriaBobot = KriteriaBobotModel::all();

        // Inisialisasi header Excel
        $data = [];

        // Tambahkan header untuk 'Nama Alternatif' ke dalam array data
        $header = ['Nama'];
        foreach ($kriteriaBobot as $kriteria) {
            $header[] = $kriteria->nama;
        }
        $data[] = $header;

        // Buat file Excel menggunakan Laravel Excel
        return Excel::download(new AlternatifKriteriaExport($data), 'template_alternatif.xlsx');
    }

    public function uploadExcelAlternatif(Request $request)
    {
        try {
            $request->validate([
                'excel_file' => 'required|mimes:xlsx,xls', // Pastikan file yang diunggah adalah file Excel
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $file = $request->file('excel_file');

        // Gunakan fasad Excel untuk mengimpor data
        $data = Excel::toArray([], $file)[0];

        // Remove first and second row from $data
        array_shift($data);

        try {
            foreach ($data as $row) {
                $alt = new AlternatifModel();
                $alt->nama = $row[0];
                $alt->save();

                $scoreIndex = 1; // Index untuk mengakses skor pada setiap baris

                // Menyimpan skor
                $kriteriabobot = KriteriaBobotModel::get();
                foreach ($kriteriabobot as $k) {
                    $skorInput = $row[$scoreIndex] ?? null;

                    $score = new AlternatifSkor();
                    $score->alternatif_id = $alt->id;
                    $score->kriteriabobot_id = $k->id;
                    $score->score = $skorInput !== null ? $skorInput : 0; // Set nilai default jika input adalah null
                    $score->save();

                    $scoreIndex++;
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal diupload. Periksa apakah ada duplikasi data.');
        }

        return redirect('/alternatif')->with('success', 'Data berhasil diupload');
    }
}

class AlternatifKriteriaExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        // Hilangkan baris header yang terduplikat
        return array_slice($this->data, 1); // Mengambil semua elemen setelah baris pertama
    }

    public function headings(): array
    {
        return $this->data[0];
    }
}
