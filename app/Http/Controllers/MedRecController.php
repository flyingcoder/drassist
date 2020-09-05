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

    public function processUpload()
    {
        $image = request()->file('image');

        $fileName   = time() . '.' . $image->getClientOriginalExtension();

        //dd();
        $path = $image->storeAs('records', $fileName, 'public');

        $ocr = new TesseractOCR();

        $ocr->image(storage_path('app/public').'/'.$path);

        $ocr->lang('eng');

        $text = $ocr->run();

        $result = $text;

        $result = $this->parseHealthCard($text);
        if(request()->has('type')) {
            $result = $this->parseHealthCard($text);
        }

        return $result;
    }

    public function uploadCard()
    {
        if(request()->hasFile('image')) {

            $text = $this->processUpload();

            return response()->json($text, 200);
        }
    }

    public function uploadRecord($id)
    {
       $record = MedRec::findOrfail($id);

       if(request()->hasFile('image')) {

            $text = $this->processUpload();

            return response()->json($text, 200);
        }
    }

    public function parseHealthCard($text)
    {
        //first line is name;
        $text = str_replace(' - ', '-', $text);

        $explode = explode(PHP_EOL, $text);

        $bdate = '';
        $gender = '';

        if(strpos($explode[4], 'F')) {
            $gender = 'F';
            $bdate = str_replace(' ', '', explode('F', $explode[4]));
        } elseif(strpos($explode[4], 'M')) {
            $bdate = str_replace(' ', '', explode('M', $explode[4]));
            $gender = 'M';
        }

        $issdate = '';
        //$issdate = explode(' ', $explode[10]);

        $parse = [
            'name' => $explode[0],
            'card_number' => $explode[1],
            //'birthdate' => $bdate[0],
            'gender' => $gender,
            'explode' => $explode,
            //'dateissue' => $issdate[0],
            //'dateexp' => $issdate[1],
            'text' => $text

        ];

        return $parse;
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
