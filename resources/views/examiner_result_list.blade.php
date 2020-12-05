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


    <table class="table border">
        <thead>
          <tr class="table-danger">

            <th scope="col">Place</th>
            <th scope="col">Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Score</th>

          </tr>
        </thead>
        <tbody>

            @php $i = ($data->currentpage()-1)* $data->perpage() + 1;@endphp

            @foreach ($data as $item)

            <tr @if($item['id'] == Auth::user()->id) class="table-success" @endif>




                <th scope="row">{{$i}}</th>
                <td>{{$item['name']}}</td>
                <td>
                    @foreach (App\User::where('id', $item['id'])->get() as $phone)
                        {{$phone->phone}}
                    @endforeach
                </td>

                <td>{{$item['marks']}}</td>


              </tr>

             @php  $i += 1; @endphp
              @endforeach




        </tbody>
      </table>

      {{ $data->withPath('')->render() }}


        </div>
    </div>
</div>



@endsection
