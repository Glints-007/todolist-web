@extends('layouts.default')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/scss/todolist.css') }}">
@endsection

@section('content')
<section class="todolist__section">
    <div class="todolist__container">
        <div class="header__section">
            <a href="{{url('/dashboard')}}">
                <i class="fas fa-chevron-left"></i><span> Back to dashboard</span>
            </a>
            <h1>Judul To Do</h1>
            <a data-toggle="modal" data-target="#subtask-modal-form">
                <i class="fas fa-plus"></i> <span>Add Subtask</span>
            </a>
        </div>
        @if ($data)
            @foreach ($data as $dataTodoList)
                <div class="todolist__item">
                    <a  href="{{ url(''.$dataTodoList->id.'/delete/todolist') }}" class="close-btn">
                        <i class="fas fa-times"></i>
                    </a>
                    <div class="img__wrapper">
                        <img src="{{ asset($dataTodoList->image) }}" alt="Uploaded image">
                    </div>
                    <div class="content__wrapper">
                        <h3>{{$dataTodoList->name}}</h3>
                        <p>{{$dataTodoList->content}}</p>
                    </div>
                    <a href="{{ url(''.$dataTodoList->id.'/show/todolist') }}" class="edit-btn">
                    <span>Edit</span>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</section>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="subtask-modal-form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ url(''.$todoId.'/store/todolist') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add To Do List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type=text name="name" class="cust-form-control" id="exampleFormControlInput1"
                            placeholder="Insert your to do list here">
                    </div>

                    <div class="form-group">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="content" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
