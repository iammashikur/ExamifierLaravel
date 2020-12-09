<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\StudentData;
use App\Notice;
use App\User;
use Carbon\Carbon;

class ResultController extends Controller
{
    function pdf($id)
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html($id));
     return $pdf->stream();
    }

    function convert_customer_data_to_html($id)
    {



        $score = [];
        $exam = Exam::where('id', $id)->orderBy('id', 'desc')->get();
        $data = '';


        foreach($exam as $ex){ $data = $ex->data;}
        foreach($exam as $dt){ $date = $dt->created_at;}


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
            $total =0;


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

                $total = $total+$data->Exam[0]->mark_mcq;

            $index++;

            }







            foreach(User::where('id', $studs->student_id)->get() as $stu)
            {
                $name = $stu->name;
            }

            $score[] = array(
                'id' => $studs->student_id,
                'name' => $name,
                'marks' => $marks,
            );

        }

        usort($score, function($a, $b) {

            if($a['marks']==$b['marks']) return 0;
            return $a['marks'] < $b['marks']?1:-1;
        });





     $customer_data = $score;
     $output = '
     <h3 align="center">'.$data->Exam[0]->name.' ('.$data->Exam[0]->subject.') - Result</h3>

     <p align="center">'.Carbon::parse($date)->format('Y-m-d h:i a').'</p>
     <p align="center">Total Mark '.$total.'</p>


     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Merit Position</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Name</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Mark</th>

   </tr>
     ';

     $position = 1;
     foreach($customer_data as $customer)
     {

      $output .= '
      <tr>

       <td style="border: 1px solid; padding:12px;">'.$position.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer['name'].'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer['marks'].'</td>

      </tr>
      ';

      $position++;
     }
     $output .= '</table>';
     return $output;
    }
}
