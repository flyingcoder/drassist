<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\MedRec;
use thiagoalessio\TesseractOCR\TesseractOCR;

class MedRecController extends Controller
{
    public function records($id)
    {
       $patient = Patient::findOrfail($id);

       return response()->json($patient->records, 200);
    }

    public function getRecord($id)
    {
       $record = MedRec::findOrfail($id);

       return response()->json($record, 200);
    }

    public function updateRecord($id)
    {
        $record = MedRec::findOrfail($id);

        $record->title = request()->title;

        $record->save();

        return response()->json($record, 200);
    }

    public function uploadRecord($id)
    {
       $record = MedRec::findOrfail($id);

       if(request()->hasFile('image')) {

            $image      = request()->file('image');

            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            //dd();
            $path = $image->storeAs('records', $fileName, 'public');

            $record->record_upload_url = $path;

            $record->save();

            $ocr = new TesseractOCR();

            $ocr->image(storage_path('app/public').'/'.$path);

            $text = $ocr->run();

            return response()->json($text, 200);
        }
    }

    public function newRecords($id)
    {
        $patient = Patient::findOrfail($id);

        request()->validate([
            'title' => 'required',
            'category' => 'required',

        ]);

        $records = $patient
                     ->records()
                     ->create(request()->all());

        return response()->json($records, 200);
    }

    public function deleteRecord($id) {

        $record = MedRec::findorFail($id);

        $record->delete();

        return response()->json($record, 204);
    }
}
