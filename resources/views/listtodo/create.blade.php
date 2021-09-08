@extends('layouts.default')

@section('content')
    <section>
        <div class="container mt-5">
            <h1>Add To do</h1>
            <div class="col-lg-8">
                <form action="{{ url($todoId.'/store/todolist') }}" method="POST" enctype="multipart/form-data">
                    @csrf
 
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="content" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="form-group mt-2">
                        <a href="{{ url($todoId.'/todolist') }}">
                            << Back</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection