@extends('layouts.default')

@section('title', 'My To Do List')

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
            <h1>{{ $todo->name }}</h1>
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
                    <a class="edit-btn" id="edit-subtask" data-toggle="modal" data-target="#subtask-edit-form" data-id="{{ $dataTodoList->id }}" onclick="fetchData({{ $dataTodoList->id }})">
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Subtask</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input name="name" class="cust-form-control" id="exampleFormControlInput1"
                            placeholder="Insert your subtask here">
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


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="subtask-edit-form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="edit-form" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subtask</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input name="name" id="name-input" class="cust-form-control" id="exampleFormControlInput1"
                            placeholder="Insert your subtask here">
                    </div>

                    <div class="form-group">
                        <div class="images">
                            <img src="" alt="" id="image-data">
                            <input type="file" name="image" id="image-input" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="content" id="content-input" rows="3" class="form-control"></textarea>
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

<script>
    const editBtn = document.getElementById('edit-subtask');
    let myForm = document.getElementById('edit-form');
    const fetchData = (id) => {
        event.preventDefault();

        fetch( '/' + id + '/show/todolist', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
            })
            .then(response => response.json())
            .then(data => {
                const name = document.getElementById('name-input');
                const content = document.getElementById('content-input');
                const image = document.getElementById('image-input');
                const imagePreview = document.getElementById('image-data');

                name.value = data.name;
                content.value = data.content;
                imagePreview.src = data.image;
                myForm.action = '/'+ id +'/update/todolist';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>
@endsection
