<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use Auth;

class ExaminerController extends Controller
{
    public function index(){

        return view('examiner_dashboard');

    }

    public function questions(Request $request){

        return view('examiner_questions', compact('request'));

    }

    public function exam_store(Request $request){

        $exam = new Exam();
        $exam->name = $request->name;
        $exam->data = $request->data;
        $exam->status = '1';
        $exam->examiner_id = Auth::user()->id;
        $exam->save();

        return redirect()->route('examiner.dashboard');

    }
}
