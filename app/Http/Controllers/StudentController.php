<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\User;
use App\StudentData;
use App\Notice;
use Auth;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function forgot(){

        return view('auth.forgot');

    }

    public function reset(Request $request){

        $exist = User::where('phone', $request->phone)->count();

        if($exist == 0){
            return redirect()->back()->with('error' , 'User Not Found!');
        }

       $count = strlen($request->password);

        if($count < 8){

            return redirect()->back()->with('error' , 'Password bust be 8 or more charecters!');

        }else{

            if($request->password == $request->password_confirmation){

                $user = User::where('phone', $request->phone)->update([

                    'password' => bcrypt($request->password),

                ]);

                return redirect()->back()->with('success' , 'Password Changed! Please Log In');

            }

            else{
                return redirect()->back()->with('error' , 'Password Not Match');
            }

        }


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


    // Leader Board

    public function leaderboard($id)
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

    if($a['marks']==$b['marks']) return 0;
    return $a['marks'] < $b['marks']?1:-1;
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


}
