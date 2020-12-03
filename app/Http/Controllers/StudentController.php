<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\StudentData;
use App\Notice;
use Auth;
use DB;

class StudentController extends Controller
{
    public function login(){

        if(@isAdmin())
        {
            return redirect()->route('admin.dashboard');
        }

        if(@isExaminer())
        {
            return redirect()->route('examiner.dashboard');
        }

        if(@isUser())
        {
            return redirect()->route('student.dashboard');
        }

        return redirect('login');
    }

    public function index()
    {
        $exams = Exam::where('status', 1)->orderBy('id', 'desc')->get();
        return view('student_dashboard',compact('exams'));
    }

    public function exams()
    {

        $exams = Exam::where('status', 1)->orderBy('id', 'desc')->get();


        return view('student_exams' , compact('exams'));
    }

    public function exam($id)
    {

        $exam = Exam::where('id', $id)->orderBy('id', 'desc')->get();


        $data = '';

        foreach($exam as $ex)
        {
            $data = $ex->data;
        }

        $data = json_decode($data);

        //$data = json_decode(json_encode($data), True);

        return view('student_exam' , compact('data'));


    }

    public function exam_complete(Request $request)
    {


        if (StudentData::where('student_id', Auth::user()->id)->where('exam_id', $request->exam_id)->count() <= 0) {

            $data =  json_encode($request->all());
            $store = new StudentData();
            $store->student_id = Auth::user()->id;
            $store->exam_id = $request->exam_id;
            $store->data = $data;
            $store->save();
            return redirect()->route('student.result', $request->exam_id);


        }
        else
        {
            return redirect()->route('student.dashboard');
        }




    }

    public function notice()
    {


        $notice = Notice::orderBy('id', 'desc')->get();
        return view('student_notice', compact('notice'));

    }

    public function results()
    {

        $results = StudentData::where('student_id', Auth::user()->id)->orderBy('id','desc')->get();
        return view('student_results',compact('results'));

    }

    public function result($id)
    {

        $exam = Exam::where('id', $id)->orderBy('id', 'desc')->get();
        $data = '';


        foreach($exam as $ex){ $data = $ex->data;}
        $data = json_decode($data);

        $my_datax = StudentData::where('student_id', Auth::user()->id)->where('exam_id', $id )->orderBy('id','desc')->limit('1')->get();

        $my_data = '';
        foreach($my_datax as $val)
        {
            $my_data = $val->data;
        }
        $my_data = json_decode($my_data);

        return view('student_result' , compact('data','id', 'my_data'));



    }


}
