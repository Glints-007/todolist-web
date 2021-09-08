@extends('layouts.default')

@section('content')
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8" >
                    <h1>To Do App</h1>
                    
                    <a href="{{route('create.todolist', ['todoId' => $todoId])}}" class="btn btn-primary"> Add Todo List</a> 
                </div>

                <div class="col-lg-8 mt-5">
                    <table class="table-bordered">
                        <tr>
                            <!-- <th>Id</th>
                            <th>User Id</th> -->
                            <th>Name</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($data as $dataTodo)
                            <tr>
                                <!-- <td>{{ $dataTodo->id }}</td>
                                <td>{{ $dataTodo->userId }}</td> -->
                                <td>{{ $dataTodo->name }}</td>
                                <td>{{ $dataTodo->content }}</td>
                                <td><img src="{{ $dataTodo->image }}" alt=""></td>
                                <td>

                                    <a href="{{ url(''.$dataTodo->id.'/show/todolist/') }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url(''.$dataTodo->id.'/delete/todolist/') }}" class="btn btn-danger">Delete</a>


                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="form-group mt-2">
                    <a href="{{ url('/dashboard') }}">
                        << Back</a>
                </div>

            </div>
        </div>
    </section>
@endsection