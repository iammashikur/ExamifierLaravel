<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\StudentData;
use App\Notice;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ExaminerController extends Controller
{
    public function index(){

        return view('examiner_dashboard');

    }

    public function exams()
    {

        $exams = Exam::orderBy('id', 'desc')->get();
        return view('examiner_exams' , compact('exams'));

    }

    public function exam_edit($id)
    {


        $exam = Exam::where('id', $id)->orderBy('id', 'desc')->get();


        $data = '';

        foreach($exam as $ex)
        {
            $data = $ex->data;
        }

        $data = json_decode($data);


        return view('examiner_exam_edit' , compact('data'));

    }

    public function exam_update(Request $request)
    {


        if($request->has('save')){

            $status = 0;

        }elseif($request->has('publish'))
        {
            $status = 1;
        }

        Exam::find($request->exam_id)->update([
            'name' => $request->name,
            'data' => $request->data,
            'status' =>  $status,
            'examiner_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('message', 'Exam Updated!');
    }


    public function questions(Request $request){

        return view('examiner_questions', compact('request'));

    }

    public function exam_store(Request $request){





        if($request->has('save')){

            $status = 0;

        }elseif($request->has('publish'))
        {
            $status = 1;
        }

        $exam = new Exam();
        $exam->name = $request->name;
        $exam->data = $request->data;
        $exam->status = $status;
        $exam->examiner_id = Auth::user()->id;
        $exam->save();

        return redirect()->route('examiner.dashboard')->with('message', 'Exam Updated!');

    }

    public function results(){

        $exams = Exam::where('status', 1)->orderBy('id', 'desc')->get();
        return view('examiner_results' , compact('exams'));

    }

    // Leader Board

    public function result_list($id)
    {

        $score = [];

        $students = StudentData::where('exam_id', $id)->orderBy('id', 'desc')->get();
        foreach ($students as $item)
{
    foreach (User::where('id', $item->student_id)
        ->get() as $student)
    {

        $index = 1;
        $marks = 0;
        $exam = Exam::find($item->exam_id)
            ->get();
        foreach ($exam as $ex)
        {
            $data = $ex->data;
        }
        $data = json_decode($data);
        $my_datax = StudentData::where('student_id', $item->student_id)
            ->where('exam_id', $item->exam_id)
            ->orderBy('id', 'desc')
            ->limit('1')
            ->get();
        foreach ($my_datax as $val)
        {
            $my_data = $val->data;
        }
        $my_data = json_decode($my_data);

        foreach ($data->McQs as $mc)
        {

            if (isset($my_data->{'mcq_' . $index}))
            {
                $my_answer = $my_data->{'mcq_' . $index};
                if ($mc->answer == $my_answer)
                {
                    $marks = $marks + $data->Exam[0]->mark_mcq;
                }
                else
                {
                    $marks = $marks - $data->Exam[0]->minus_mark_mcq;
                }
            }

            $index++;

        }

        $score[] = array(
            'id' => $item->student_id,
            'name' => $student->name,
            'marks' => $marks,
        );

    }
}

usort($score, function($a, $b) {
    return $a['marks'] <=> $b['marks'];
});


$data = $this->paginate($score);

        return view('student_leaderboard', compact('data'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function student_result($student_id, $exam_id)
    {

        $exam = Exam::where('id', $exam_id)->orderBy('id', 'desc')->get();
        $data = '';


        foreach($exam as $ex){ $data = $ex->data;}
        $data = json_decode($data);

        $my_datax = StudentData::where('student_id', $student_id)->where('exam_id', $exam_id )->orderBy('id','desc')->limit('1')->get();

        $my_data = '';
        foreach($my_datax as $val)
        {
            $my_data = $val->data;
        }
        $my_data = json_decode($my_data);

        return view('examiner_result_list' , compact('data','id', 'my_data'));

    }

    public function notice()
    {

        $notice = Notice::orderBy('id', 'desc')->get();
        return view('examiner_notice', compact('notice'));
    }

    public function notice_insert(Request $request)
    {
        $notice =  new Notice();
        $notice->notice = $request->notice;
        $notice->save();

        return redirect()->route('examiner.notice_all')->with('message', 'NOtice Added!');

    }

    public function notice_delete($id)
    {

        $notice = Notice::find($id)->delete();

       return redirect()->route('examiner.notice_all')->with('message', 'Notice Deleted!');
    }

}
