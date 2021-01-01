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
    public function index()
    {

        return view('examiner_dashboard');

    }

    public function exams()
    {

        $exams = Exam::orderBy('id', 'desc')->get();
        return view('examiner_exams', compact('exams'));

    }

    public function exam_edit($id)
    {

        $exam = Exam::where('id', $id)->orderBy('id', 'desc')
            ->get();

        $data = '';

        foreach ($exam as $ex)
        {
            $data = $ex->data;
        }

        $data = json_decode($data);

        return view('examiner_exam_edit', compact('data'));

    }

    public function exam_update(Request $request)
    {

        if ($request->has('save'))
        {

            $status = 0;

        }
        elseif ($request->has('publish'))
        {
            $status = 1;
        }

        Exam::find($request->exam_id)
            ->update(['name' => $request->name, 'data' => $request->data, 'status' => $status, 'examiner_id' => Auth::user()->id, ]);

        return redirect()
            ->back()
            ->with('message', 'Exam Updated!');
    }

    public function questions(Request $request)
    {

        return view('examiner_questions', compact('request'));

    }

    public function exam_store(Request $request)
    {

        if ($request->has('save'))
        {

            $status = 0;

        }
        elseif ($request->has('publish'))
        {
            $status = 1;
        }

        $exam = new Exam();
        $exam->name = $request->name;
        $exam->data = $request->data;
        $exam->status = $status;
        $exam->examiner_id = Auth::user()->id;
        $exam->save();

        return redirect()
            ->route('examiner.dashboard')
            ->with('message', 'Exam Updated!');

    }

    public function results()
    {

        $exams = Exam::where('status', 1)->orderBy('id', 'desc')
            ->get();
        return view('examiner_results', compact('exams'));

    }

    // Leader Board
    public function result_list($id)
    {


        $score = [];
        $exam = Exam::where('id', $id)->orderBy('id', 'desc')->get();
        $data = '';


        foreach($exam as $ex){ $data = $ex->data;}
        $data = json_decode($data);

        foreach(StudentData::where('exam_id', $id )->orderBy('id','desc')->get() as $studs)
        {

            $my_datax = StudentData::where('student_id',  $studs->student_id )->where('exam_id', $id )->orderBy('id','desc')->limit('1')->get();

            $my_data = '';
            foreach($my_datax as $val)
            {
                $my_data = $val->data;
            }
            $my_data = json_decode($my_data);


            $index =1;
            $marks =0;


            foreach ($data->McQs as $mc){

                if (isset($my_data->{'mcq_'.$index})) {
                    $my_answer = $my_data->{'mcq_'.$index};
                    if ($mc->answer == $my_answer)
                    {

                        $marks+= $data->Exam[0]->mark_mcq;
                    }
                    else
                    {

                        $marks-= $data->Exam[0]->minus_mark_mcq;
                    }
                }
                else {
                    $my_answer = "0";

                }
            $index++;

            }

            foreach(User::where('id', $studs->student_id)->get() as $stu)
            {
                $name = $stu->name;
                $phone = $stu->phone;
            }

            $score[] = array(
                'id' => $studs->student_id,
                'name' => $name,
                'phone' => $phone,
                'marks' => $marks,
            );

        }

        usort($score, function($a, $b) {

            if($a['marks']==$b['marks']) return 0;
            return $a['marks'] < $b['marks']?1:-1;
        });



        //print_r($score);

        $data    = $this->paginate($score);

        $exam_id =$id;

        return view('examiner_leaderboard', compact('data', 'exam_id' ,'score'));

    }

    public function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ? : (Paginator::resolveCurrentPage() ? : 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage) , $items->count() , $perPage, $page, $options);
    }

    public function student_result($student_id, $exam_id)
    {

        $exam = Exam::where('id', $exam_id)->orderBy('id', 'desc')
            ->get();
        $data = '';

        foreach ($exam as $ex)
        {
            $data = $ex->data;
        }
        $data = json_decode($data);

        $my_datax = StudentData::where('student_id', $student_id)->where('exam_id', $exam_id)->orderBy('id', 'desc')
            ->limit('1')
            ->get();

        $my_data = '';
        foreach ($my_datax as $val)
        {
            $my_data = $val->data;
        }
        $my_data = json_decode($my_data);

        return view('examiner_result_list', compact('data', 'id', 'my_data'));

    }

    public function notice()
    {

        $notice = Notice::orderBy('id', 'desc')->get();
        return view('examiner_notice', compact('notice'));
    }

    public function notice_insert(Request $request)
    {
        $notice = new Notice();
        $notice->notice = $request->notice;
        $notice->save();

        return redirect()
            ->route('examiner.notice_all')
            ->with('message', 'Notice Added!');

    }

    public function notice_delete($id)
    {

        $notice = Notice::find($id)->delete();

        return redirect()
            ->route('examiner.notice_all')
            ->with('message', 'Notice Deleted!');
    }

}

