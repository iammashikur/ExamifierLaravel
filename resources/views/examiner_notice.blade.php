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
                <li class="breadcrumb-item active"><a>Notice</a></li>
              </ol>

            <form action="{{route('examiner.notice')}}" method="POST" class="mb-4">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Write a Notice</label>
                    <textarea class="form-control border" id="exampleFormControlTextarea1" rows="3" name="notice" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-success btn-sm">Publish</button>
            </form>


            <table class="table table-hover border">
                <thead>
                  <tr>
                    <th scope="col">Notice</th>
                    <th scope="col" style="min-width: 180px">Publish Date</th>
                    <th scope="col" style="min-width: 100px">Action</th>

                  </tr>
                </thead>
                <tbody>


                    @foreach ($notice as $item)
                    <tr>
                        <th scope="row" class="text-justify">{{$item->notice}}</th>
                        <td>{{date('h:i A - d M Y', strtotime($item->created_at))}}</td>
                        <td>



                        <a href="{{route('examiner.notice_delete', ['id' => $item->id])}}" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> DELETE</a>









                        </td>

                      </tr>


                   @endforeach




                </tbody>
            </table>





        </div>
    </div>
</div>



@endsection
