<?php


namespace App\Http\Controllers;


use App\Http\Requests\ExcelUploadRequest;
use App\Models\Data;
use App\UseCases\FileUploadHandler;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Importer;


class FileController
{
    public function upload(ExcelUploadRequest $request, FileUploadHandler $fileUploadHandler): RedirectResponse
    {
        $fileUploadHandler->handle($request);

        return back()->with('success', 'Upload successfull');
    }

    public function data()
    {
        return view('data', ['rows' => Data::orderBy('date')->get()]);
    }
}
