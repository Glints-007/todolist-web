@extends('layouts.default')

@section('content')
    <section>
        <div class="container mt-5">
            <h1>Edit To do</h1>
            <div class="col-lg-8">
                <form action="{{ url('/update/todo/'. $data->id) }}" method="PUT" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="name" class="form-control" value={{$data->name}}>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                    <div class="form-group mt-2">
                        <a href="{{ url('/dashboard') }}">
                            << Back</a>
                    </div>

                </form>
<section>
    <div class="container mt-5">
        <h1>Edit To do</h1>
        <div class="col-lg-8">
            <form action="{{ url('/update/todo/'. $data->id) }}" method="POST">
                @csrf
                <!--<div class="form-group">
                        <label for="nama">User Id</label>
                        <input type="text" name="userId" class="form-control" value={{$data->userId}}>
                    </div> -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="name" class="form-control" value={{$data->name}}>
                </div>

                <!-- <div class="form-group">
                        <label for="nama">Date</label>
                        <input type="date" name="date" class="form-control" value={{$data->date}}>
                    </div> -->
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <div class="form-group mt-2">
                    <a href="{{ url('/dashboard') }}">
                        << Back</a> </div> </form> </div> </div> </section> @endsection
