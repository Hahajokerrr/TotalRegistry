<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPExcel_IOFactory;

class CarRegisterController extends Controller
{
    public function index()
    {
        return inertia('CarRegister/CarRegister');
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // Retrieve the uploaded file from the request
        $file = $request->file('file');

        // Store the uploaded file temporarily
        $filePath = $file->store('temp');

        // Load the Excel file
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('app/' . $filePath));

        // Continue with your logic to process the Excel data and create car records

        // Example: Get the data from the first sheet
        $sheet = $objPHPExcel->getActiveSheet();
        $data = $sheet->toArray();

        // Iterate over the data and process the car records

        // Cleanup the temporary file
        Storage::delete($filePath);

        // Return a response or redirect back
        return redirect()->route('car-register')->with('success', 'Nhập liệu thành công!');
    }
}
