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

            <div class="exam-create">

                <h2 class="text-center mb-4">Create Exam</h2>
                <form action="{{route('examiner.questions')}}" method="get">
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Exam Name</label>
                                <input name="name" class="form-control" required type ="text">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Subject</label>
                                <input name="subject" class="form-control" required type ="text">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Chapter/Topic</label>
                                <input name="topic" class="form-control" required type ="text">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Time (min)</label>
                                <input name="time" class="form-control" required type ="number" step="0.01">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Toal McQ Questions</label>
                                <input name="total_mcq" class="form-control" required type ="number">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Per McQ Mark</label>
                                <input name="mark_mcq" class="form-control" required type ="number" step="0.01">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Per McQ (-) Minus Mark</label>
                                <input name="minus_mark_mcq" class="form-control" required type="number" step="0.01">
                            </div>
                        </div>

                        {{-- <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Toal True/False Questions</label>
                                <input name="total_trf" class="form-control" required type ="number">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Per True/False Mark</label>
                                <input name="trf_mark" class="form-control" required type ="number">
                            </div>
                        </div> --}}

                        <div class="col-md-12 col-12">
                            <button class="btn btn-primary float-right" type="submit"><i class="fas fa-arrow-right"></i> Next</button>
                        </div>
                    </div>
                </form>
            </div>




        </div>
    </div>
</div>


@endsection
