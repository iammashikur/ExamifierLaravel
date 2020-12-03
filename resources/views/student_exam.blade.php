@extends('layouts.app')

@section('content')




<div class="container exam-conatiner">


    <div class="row">
        <div class="col-12 mb-4">

            @foreach ($data->Exam as $xm)
                <h2 class="text-center mt-4">{{ $xm->name}}</h2>
                <p class="text-center mt-4">Subject : {{ $xm->subject}}</p>
                @php
                    $xm_time = $xm->time;
                @endphp
            @endforeach

            <center>
                <p class="btn btn-default btn-sm mb-4">
                    +1 / -0.5 (For Wrong Answer)
                </p>
            </center>


        </div>
    </div>



    <div class="row">
        <div class="col-md-12">

            <div class="exam-form mb-4">
            <form id="examForm" class="mt-4" action="{{route('student.exam_complete')}}" method="POST">
                @csrf

            <input type="hidden" value="{{Request::segment(3)}}" name="exam_id">

                    <div class="row">

                        <div class="col-12 sticky-top">

                            <div class="bg-white pt-4">
                                <button type="button" class="btn btn-secondary mb-4">MCQ Question</button> <p class="btn btn-primary mb-4" id="counter"></p>
                            </div>



                        </div>

                        @php
                        $index = 1;
                        @endphp

                        @foreach ($data->McQs as $mc)

                        <div class="col-md-6 col-12 mb-4">

                            <div class="mcq-box border p-4">

                                <div class="row">

                                    <div class="col-12 mb-2">

                                        <p class="btn btn-defaullt btn-sm mb-4">
                                            MCQ => {{$index}}
                                        </p>



                                        <p>{{$mc->question}}</p>

                                    </div>

                                    <div class="col-12">
                                        <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_1" value="A">
                                              {{$mc->mcq_1}}
                                            </label>
                                          </div>
                                          <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_2" value="B">
                                              {{$mc->mcq_2}}
                                            </label>
                                          </div>

                                          <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_3" value="C">
                                              {{$mc->mcq_3}}
                                            </label>
                                          </div>

                                          <div class="form-check mb-2">
                                            <label class="form-check-label">
                                              <input class="form-check-input" type="radio" name="mcq_{{$mc->id}}" id="mcq_{{$mc->id}}_4" value="D">
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








{{--
                        <div class="col-12">

                            <button type="button" class="btn btn-secondary mb-4">True/False Question</button>

                        </div>

                        <div class="col-md-6 col-12 mb-4">

                            <div class="mcq-box border p-4">

                                <div class="row">

                                    <div class="col-12 mb-2">

                                        <p class="btn btn-defaullt btn-sm mb-4">
                                            question number 1
                                        </p>

                                        <p class="btn btn-default btn-sm mb-4">
                                            +0.5 / -0.25 (For Wrong Answer)
                                        </p>

                                        <p>Lorem ipsum dolor sit amet, possit elaboraret theophrastus ea mea, et has quis eirmod consetetur. Iriure contentiones qui ei, his eu nonumes platonem adolescens. Vix eruditi molestie ad, cu tantas putant voluptatibus
                                            eos. Cum ei dolore eligendi theophrastus, nam utinam pertinacia scribentur at.</p>

                                    </div>

                                    <div class="col-12">
                                        <div class="true-false mb-2">

                                            <div class="row">

                                                <div class="col-6 mb-2">

                                                    a) Lorem ipsum dolor sit amet, possit elaboraret theophrastus ea mea.
                                                </div>

                                                <div class="col-6 mb-2 d-flex">
                                                    <div class="custom-control custom-radio mr-4">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">True</label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">False</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="true-false mb-2">

                                            <div class="row">

                                                <div class="col-6 mb-2">

                                                    a) Lorem ipsum dolor sit amet, possit elaboraret theophrastus ea mea.
                                                </div>

                                                <div class="col-6 mb-2 d-flex">
                                                    <div class="custom-control custom-radio mr-4">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">True</label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">False</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                        <div class="true-false mb-2">

                                            <div class="row">

                                                <div class="col-6 mb-2">

                                                    a) Lorem ipsum dolor sit amet, possit elaboraret theophrastus ea mea.
                                                </div>

                                                <div class="col-6 mb-2 d-flex">
                                                    <div class="custom-control custom-radio mr-4">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">True</label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">False</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="true-false mb-2">

                                            <div class="row">

                                                <div class="col-6 mb-2">

                                                    a) Lorem ipsum dolor sit amet, possit elaboraret theophrastus ea mea.
                                                </div>

                                                <div class="col-6 mb-2 d-flex">
                                                    <div class="custom-control custom-radio mr-4">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">True</label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">False</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="true-false mb-2">

                                            <div class="row">

                                                <div class="col-6 mb-2">

                                                    a) Lorem ipsum dolor sit amet, possit elaboraret theophrastus ea mea.
                                                </div>

                                                <div class="col-6 mb-2 d-flex">
                                                    <div class="custom-control custom-radio mr-4">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">True</label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">False</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>







                                </div>

                            </div>





                        </div> --}}


                    </div>


                    <button type="submit" class="btn btn-success">Submit</button>




                </form>
            </div>

        </div>
    </div>
</div>


<script>
    var varTimerInMiliseconds = 3600000*<?= $xm_time ?>;
    setTimeout(function(){
        document.getElementById("examForm").submit();
    }, varTimerInMiliseconds);
</script>

<script>

    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 *<?= $xm_time ?>,
        display = document.querySelector('#counter');
    startTimer(fiveMinutes, display);
};

</script>



@endsection
