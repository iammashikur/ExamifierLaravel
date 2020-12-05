@extends('layouts.app')

@section('content')



<div class="container exam-conatiner">

    <center>
        <h1 class="mb-5">Leader Board</h1>
    </center>



    <table class="table border">
        <thead>
          <tr class="table-danger">

            <th scope="col">Place</th>
            <th scope="col">Name</th>

            <th scope="col">Score</th>

          </tr>
        </thead>
        <tbody>

            @php $i = ($data->currentpage()-1)* $data->perpage() + 1;@endphp

            @foreach ($data as $item)

            <tr @if($item['id'] == Auth::user()->id) class="table-success" @endif>

                <th scope="row">{{$i}}</th>
                <td>{{$item['name']}}</td>
                <td>{{$item['marks']}}</td>
                
              </tr>

             @php  $i += 1; @endphp
              @endforeach




        </tbody>
      </table>

      {{ $data->withPath('')->render() }}










</div>




@endsection
