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
                                <td>{{ $dataTodoList->name }}</td>
                                <td>{{ $dataTodoList->Image }}</td>
                                <td>{{ $dataTodoList->date }}</td>
                                <td>
                                    <a href="{{ url('/show/todolist/'.$dataTodoList->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/delete/todolist/'.$dataTodoList->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection