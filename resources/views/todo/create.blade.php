@extends('layouts.default')

@section('content')
    <section>
        <div class="container mt-5">
            <h1>Add To do</h1>
            <div class="col-lg-8">
                <form action="{{ url('/store/todo') }}" method="POST">
                    @csrf
                    <!-- <div class="form-group">
                        <label for="nama">User Id</label>
                        <input type="text" name="userId" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <!-- <div class="form-group">
                        <label for="nama">Date</label>
                        <input type="date" name="date" class="form-control">
                    </div> -->
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="form-group mt-2">
                        <a href="{{ url('/todo') }}">
                            << Back</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
