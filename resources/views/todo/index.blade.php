@extends('layouts.default')

@section('content')
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <h1>Todo App</h1>
                    <a href="{{url('create/todo')}}" class="btn btn-primary"> Add Todo</a>
                </div>

                <div class="col-lg-8 mt-5">
                    <table class="table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($data as $dataTodo)
                            <tr>
                                <td>{{ $dataTodo->id }}</td>
                                <td>{{ $dataTodo->userId }}</td>
                                <td>{{ $dataTodo->name }}</td>
                                <td>{{ $dataTodo->date }}</td>
                                <td>
                                    <a href="{{ url('/show/todo/'.$dataTodo->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/delete/todo/'.$dataTodo->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection