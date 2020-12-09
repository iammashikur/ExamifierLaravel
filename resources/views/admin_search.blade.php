@extends('layouts.app')

@section('content')




<div class="container">
    <div class="row">


        <div class="col-md-12 mt-4">

            @if(session('success'))


            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{session('success')}}
                </div>



            @endif


        <button class="btn btn-default mr-4">Examiners</button><a href="{{route('admin.add_examiner')}}" class="btn btn-primary">Add</a>

            <table class="table mb-4 border mt-4">
                <thead>
                  <tr>
                    <th scope="col">Examiner Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>


                    @foreach ($examiners as $student)
                    <tr class="table-active">

                    <th scope="row">{{$student->name}}</th>
                    <td>{{$student->phone}}</td>
                    <td>{{$student->created_at}}</td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="{{route('admin.delete', ['id' =>$student->id])}}">Delete</a>
                        <a class="btn btn-primary btn-sm" href="{{route('admin.edit', ['id' =>$student->id])}}">Edit</a>
                    </td>

                    </tr>
                    @endforeach


                </tbody>
              </table>

              {{$examiners->links()}}


              <button class="btn btn-default mr-4">Students</button><a href="{{url('admin/search')}}" class="btn btn-primary">Add</a>

            <form class="form-inline float-right" method="GET" action="{{route('search')}}">

                <input class="form-control mr-sm-2" type="text" value="{!!$request->search!!}" name="search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
              </form>


              <table class="table mb-4 mt-4 border">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>


                    @foreach ($students as $student)
                    <tr class="table-active">

                    <th scope="row">{{$student->name}}</th>
                    <td>{{$student->phone}}</td>
                    <td>{{$student->created_at}}</td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="{{route('admin.delete', ['id' =>$student->id])}}">Delete</a>
                        <a class="btn btn-primary btn-sm" href="{{route('admin.edit', ['id' =>$student->id])}}">Edit</a>

                    </td>

                    </tr>
                    @endforeach


                </tbody>
              </table>

              {{$students->links()}}






        </div>
    </div>
</div>


@endsection
