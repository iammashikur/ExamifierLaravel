@extends('layouts.app')

@section('content')



<div class="container exam-conatiner">


    <div class="row">
        <div class="col-12 mb-4">
            @foreach ($data->Exam as $xm)

                <h2 class="text-center mt-4">{{ $xm->name}}</h2>
                <p class="text-center mt-2">Subject : {{ $xm->subject}}</p>

            @endforeach
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">

            <div class="exam-form mb-4">



            <input type="hidden" value="{{Request::segment(3)}}" name="exam_id">

                    <div class="row">

                        <div class="col-12 col-12">

                            <button type="button" class="btn btn-secondary mb-4">MCQ Question</button>
                            <button type="button" class="btn btn-dark mb-4" id="result"></button>

                        </div>

                        @php
                            $index =1;
                            $marks =0;
                        @endphp

                        @foreach ($data->McQs as $mc)

                            @php




                            if (isset($my_data->{'mcq_'.$index})) {

                                $my_answer = $my_data->{'mcq_'.$index};

                                if ($mc->answer == $my_answer)
                                {
                                    $status = "correct";
                                    $marks =$marks+1;
                                }

                                else

                                {
                                    $status = "incorrect";
                                    $marks =$marks-0.5;
                                }

                            }
                            else {
                                $my_answer = "0";
                                $status = "incorrect";
                            }

                            @endphp

                        <div class="col-md-6 col-12 mb-4">

                            <div class="mcq-box border p-4" @if($status == "correct") style="background: rgb(203, 204, 247)" @else style="background: rgb(247, 200, 200)"  @endif>

                                <div class="row">

                                    <div class="col-12 mb-2">

                                        <p class="btn btn-success btn-sm mb-4">
                                            ({{$index}})
                                        </p>


                                        @if($status == "correct")
                                        <p class="btn btn-success btn-sm mb-4">
                                            Correct Answer
                                        </p>
                                        @else
                                        <p class="btn btn-danger btn-sm mb-4">
                                            Incorrect Answer
                                        </p>

                                        <p class="btn btn-success btn-sm mb-4">
                                            Correct : {{$mc->answer}}
                                        </p>
                                        @endif



                                        <p>{{$mc->question}}</p>

                                    </div>



                                    <div class="col-12">
                                        <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_1" value="A" @if ($my_answer == "A") checked @endif>
                                              {{$mc->mcq_1}}
                                            </label>
                                          </div>
                                          <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_2" value="B" @if ($my_answer == "B") checked @endif>
                                              {{$mc->mcq_2}}
                                            </label>
                                          </div>

                                          <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_3" value="C" @if ($my_answer == "C") checked @endif>
                                              {{$mc->mcq_3}}
                                            </label>
                                          </div>

                                          <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_4" value="D" @if ($my_answer == "D") checked @endif>
                                              {{$mc->mcq_4}}
                                            </label>
                                          </div>

                                    </div>








                                </div>

                            </div>



                        </div>


                    @php
                        $index++;
                    @endphp
                    @endforeach



                    </div>





            </div>

        </div>
    </div>
</div>


<script>
    $(function() {
        $("#result").html("Your Total Marks: {{$marks}}");
    });
</script>



@endsection
