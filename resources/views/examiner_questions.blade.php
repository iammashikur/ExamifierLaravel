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

            <form action="{{route('examiner.exam_store')}}" method="POST">



                <input type="hidden" name="name" value="{{$request->name}}">
                <input type="hidden" name="subject" value="{{$request->subject}}">
                <input type="hidden" name="topic" value="{{$request->topic}}">
                <input type="hidden" name="time" value="{{$request->time}}">
                <input type="hidden" name="total_mcq" value="{{$request->total_mcq}}">
                <input type="hidden" name="mark_mcq" value="{{$request->mark_mcq}}">
                <input type="hidden" name="minus_mark_mcq" value="{{$request->minus_mark_mcq}}">


            @csrf


            @for ($i = 0; $i < $request->total_mcq; $i++)
                <div class="mcq-box border p-4  mb-4 bg-one">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-danger btn-sm btn-number">{{$i+1}}</button>
                            <button class="btn btn-default btn-sm">MCQ</button>
                            <input id="mcqId-{{$i}}" data="mcqId" type="hidden" value="1" />
                            <textarea id="mcqQue-{{$i}}" data="mcqQue" type="text" class="custom-textarea w-100 mt-2" rows="10" id="exampleFormControlInput1" required></textarea>
                        </div>
                        @for ($o = 1; $o < 5; $o++)
                        <div class="col-12 mb-2">
                           <button class="btn btn-default btn-sm btn-number mb-2">{{$o}}</button> <textarea id="mcq{{$o}}-{{$i}}" data="mcq"  class="w-100 custom-textarea" required></textarea>
                        </div>
                        @endfor
                        <div class="col-12 mb-2 mt-4">

                            <div class="form-group">
                                <select class="custom-select" id="mcqAns-{{$i}}" data="mcqAns" onselect="($)" required>
                                  <option value="">--Select answer--</option>
                                  <option value="A">A is correct answer</option>
                                  <option value="B">B is correct answer</option>
                                  <option value="C">C is correct answer</option>
                                  <option value="D">D is correct answer</option>
                                </select>
                              </div>

                        </div>
                    </div>
                </div>
            @endfor





            @for ($i = 0; $i < $request->total_trf; $i++)
            <div class="mcq-box border p-4  mb-4 bg-two">
                <div class="row">
                    <div class="col-12 mb-2">
                        <button class="btn btn-danger btn-sm btn-number">{{$request->total_mcq+$i+1}}</button>
                        <button class="btn btn-default btn-sm">True / False</button>
                        <input id="TrFsId-{{$i}}" data="TrFsId" type="hidden" value="1" />
                        <textarea id="TrFsQue-{{$i}}" data="TrFsQue" type="text" class="custom-textarea w-100 mt-2" rows="10" id="exampleFormControlInput1" required></textarea>
                    </div>
                    @for ($o = 1; $o < 5; $o++)
                    <div class="col-12 mb-2">

                        <button class="btn btn-default btn-sm btn-number mb-2">{{$o}}</button>

                        <div class="trfls">


                            <textarea id="TrFs{{$o}}-{{$i}}" data="TrFs"  class="w-100 custom-textarea" required></textarea>

                            <div class="form-group">
                             <select class="custom-select" id="TrFsAns{{$o}}-{{$i}}" data="TrFsAns" required>
                               <option value="">--Select True/False--</option>
                               <option value="T">True</option>
                               <option value="F">Faslse</option>
                             </select>
                           </div>


                        </div>




                    </div>


                    @endfor
                </div>
            </div>
            @endfor


            <input type="hidden" value="" id="data" name="data">


            <button class="btn btn-primary float-right ml-2" style="width: 100px" type="submit" name="save"><i class="fas fa-save"></i> Save</button>
            <button class="btn btn-success float-right" style="width: 100px" type="submit" name="publish"><i class="fas fa-save"></i> Publish</button>

        </form>





        </div>
    </div>



</div>




<script>
(function ($) {
    var result = {
      Exam: [],
      McQs: [],
      TrFs: [],
    }
    $('textarea, input, select, body').on('change click keyup keydown load', function(){

      result.Exam[0] = {
        name: "{{$request->name}}",
        subject: "{{$request->subject}}",
        topic: "{{$request->topic}}",
        time: "{{$request->time}}",
        total_mcq: "{{$request->total_mcq}}",
        mark_mcq: "{{$request->mark_mcq}}",
        minus_mark_mcq: "{{$request->minus_mark_mcq}}",
      }

      const currentInputData = $(this).attr('data')
      const currentInputId = $(this).attr('id')
      const currentInputIndex =
        currentInputId && parseInt(currentInputId.split('-')[1])

      if (currentInputData === 'mcqAns' || currentInputData === 'mcq' || currentInputData === 'mcqQue') {
        result.McQs[currentInputIndex] = {
          id: currentInputIndex + 1,
          question: $(`#mcqQue-${currentInputIndex}`).val(),
          answer: $(`#mcqAns-${currentInputIndex}`).val(),
          mcq_1: $(`#mcq1-${currentInputIndex}`).val(),
          mcq_2: $(`#mcq2-${currentInputIndex}`).val(),
          mcq_3: $(`#mcq3-${currentInputIndex}`).val(),
          mcq_4: $(`#mcq4-${currentInputIndex}`).val(),
        }
      } else if (
        currentInputData === 'TrFsAns' ||  currentInputData === 'TrFs' || currentInputData === 'TrFsQue') {
        result.TrFs[currentInputIndex] = {
          id: currentInputIndex + 1,

          question: $(`#TrFsQue-${currentInputIndex}`).val(),


          trfs_ans_1: $(`#TrFsAns1-${currentInputIndex}`).val(),
          trfs_ans_2: $(`#TrFsAns2-${currentInputIndex}`).val(),
          trfs_ans_3: $(`#TrFsAns3-${currentInputIndex}`).val(),
          atrfs_ns_4: $(`#TrFsAns4-${currentInputIndex}`).val(),

          trfs_1: $(`#TrFs1-${currentInputIndex}`).val(),
          trfs_2: $(`#TrFs2-${currentInputIndex}`).val(),
          trfs_3: $(`#TrFs3-${currentInputIndex}`).val(),
          trfs_4: $(`#TrFs4-${currentInputIndex}`).val(),
        }
      }

      var json = JSON.stringify(result)
      $('#data').val(json)

    })
  })(jQuery);
</script>


@endsection
