@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-3 mt-4">

            <div class="list-group">

                <a href="{{url('examiner/dashboard')}}" class="list-group-item list-group-item-action active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="{{url('examiner/exams')}}" class="list-group-item list-group-item-action"><i class="fas fa-pencil-ruler"></i> Exams</a>
                <a href="{{url('examiner/results')}}" class="list-group-item list-group-item-action"><i class="fas fa-clock"></i> Results</a>
                <a href="{{url('examiner/notice')}}" class="list-group-item list-group-item-action"><i class="fas fa-exclamation-triangle"></i> Notice</a>

            </div>

        </div>


        <div class="col-md-9 mt-4">


            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a>Examiner</a></li>
                <li class="breadcrumb-item"><a>Exam Results</a></li>
                <li class="breadcrumb-item active"><a>Student Results List</a></li>
              </ol>


            <table class="table table-hover border">
                <thead>
                  <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Exam Date</th>
                    <th scope="col">Total Mark</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>


                    @foreach ($students as $item)


                    @foreach (App\User::where('id', $item->student_id)->get() as $student)


                    <tr>
                        <th scope="row">{{$student->name}}</th>
                        <td>{{date('h:i A - d M Y', strtotime($item->created_at))}}</td>
                        <td>



                            @php

                                $index =1;
                                $marks =0;

                                $exam = App\Exam::find($item->exam_id)->get();

                                foreach($exam as $ex){ $data = $ex->data;}

                                $data = json_decode($data);

                                $my_datax = App\StudentData::where('student_id', $item->student_id )->where('exam_id', $item->exam_id )->orderBy('id','desc')->limit('1')->get();
                                foreach($my_datax as $val){$my_data = $val->data;}
                                $my_data = json_decode($my_data);

                            @endphp


                            @foreach ($data->McQs as $mc)
                            @php




                            if (isset($my_data->{'mcq_'.$index})) {

                                $my_answer = $my_data->{'mcq_'.$index};

                                if ($mc->answer == $my_answer)
                                {
                                    $marks =$marks+1;
                                }

                                else

                                {
                                    $marks =$marks-0.5;
                                }

                            }
                            @endphp


                            @php
                                $index++;
                            @endphp
                            @endforeach

                            {{$marks}}







                        </td>
                        <td>
                            <a href="{{route('examiner.student_result', ['student_id' => $item->student_id, 'exam_id' => $item->exam_id])}}" class="btn btn-info btn-sm">Details</a>
                        </td>
                      </tr>





                    @endforeach
                   @endforeach




                </tbody>
            </table>

            <div class="row">









            </div>


        </div>
    </div>
</div>



@endsection
