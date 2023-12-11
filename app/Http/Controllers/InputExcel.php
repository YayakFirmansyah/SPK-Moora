<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KriteriaBobotModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InputExcel extends Controller
{
    public function uploadExcelKriteria(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls', // Make sure the uploaded file is an Excel file
        ]);

        $file = $request->file('excel_file');

        // Use the Excel facade to import the data
        $data = Excel::toArray([], $file)[0];

        // Remove first and second row from $data
        // The first and second row of an Excel file are headings
        array_shift($data);
        array_shift($data);

        // Assuming the data has a header row and starts from the second row
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
            return redirect()->back()->with('error', 'Data Gagal Diupload');
        }

        return redirect('/kriteriabobot')->with('sukses', 'Data Berhasil Diupload');
    }
}
