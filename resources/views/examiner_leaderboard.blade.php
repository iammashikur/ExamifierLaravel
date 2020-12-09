@extends('layouts.app')

@section('content')



<div class="container exam-conatiner">

    <center>
        <h1 class="mb-5">Result Board</h1>
    </center>




<a href="{{route('pdf',['exam_id' => $exam_id])}}" class="btn btn-danger btn-sm mb-4"><i class="fas fa-file-pdf"></i> Export PDF</a>



    <table class="table border">
        <thead>
          <tr class="table-danger">

            <th scope="col">Merit Position</th>
            <th scope="col">Name</th>

            <th scope="col">Mark</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody>

            @php $i = ($data->currentpage()-1)* $data->perpage() + 1;@endphp

            @foreach ($data as $item)

            <tr @if($item['id'] == Auth::user()->id) class="table-success" @endif>

                <th scope="row">{{$i}}</th>
                <td>{{$item['name']}}</td>
                <td>{{$item['marks']}}</td>

                <td>
                    <a href="{{route('examiner.student_result', ['student_id' => $item['id'], 'exam_id' => $exam_id])}}" class="btn btn-primary btn-sm">View</a>
                </td>


              </tr>

             @php  $i += 1; @endphp
              @endforeach




        </tbody>
      </table>

      {{ $data->withPath('')->render() }}










</div>




@endsection
