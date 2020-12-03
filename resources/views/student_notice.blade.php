@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-3 mt-4">

            <div class="list-group">

                <a href="{{url('student/dashboard')}}" class="list-group-item list-group-item-action active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="{{url('student/exams')}}" class="list-group-item list-group-item-action"><i class="fas fa-pencil-ruler"></i> Exams</a>
                <a href="{{url('student/results')}}" class="list-group-item list-group-item-action"><i class="fas fa-clock"></i> Results</a>
                <a href="{{url('student/notice')}}" class="list-group-item list-group-item-action"><i class="fas fa-exclamation-triangle"></i> Notice</a>

            </div>

        </div>


        <div class="col-md-9 mt-4">


            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a>student</a></li>
                <li class="breadcrumb-item active"><a>Notice</a></li>
              </ol>

              <table class="table table-hover border">
                <thead>
                  <tr>
                    <th scope="col">Notice</th>
                    <th scope="col" style="min-width: 180px">Publish Date</th>


                  </tr>
                </thead>
                <tbody>


                    @foreach ($notice as $item)
                    <tr>
                        <th scope="row" class="text-justify">{{$item->notice}}</th>
                        <td>{{date('h:i A - d M Y', strtotime($item->created_at))}}</td>
                        <td>











                        </td>

                      </tr>


                   @endforeach




                </tbody>
            </table>




        </div>
    </div>
</div>



@endsection
