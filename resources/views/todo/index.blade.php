@extends('layouts.default')

@section('content')
<main>
    <div class="d-flex align-items-center mb-4">
        <div class="add-btn">
            <a data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a>
        </div>
        <h1 class="w-100 heading-text">To Do List</h1>
    </div>
    <div class="container box-container">
        @foreach ($data as $dataTodo)
        <div class="box">
            <div class="close-btn">
                <a href="{{ url('/delete/todo/'.$dataTodo->id) }}"><i class="fas fa-times"></i></a>
            </div>
            <form action="{{ url('/update/todo/'.$dataTodo->id) }}" method="POST" id="form-update-{{ $dataTodo->id }}">
                @csrf
                <textarea type="text" name="name" class="box__input" id="item-{{ $dataTodo->id }}"
                    oninput="editItem({{ $dataTodo->id }})">{{ $dataTodo->name }}</textarea>
            </form>
            <div class="edit-btn">
                <a href="{{ url('/show/todo/'.$dataTodo->id) }}"><i class="fas fa-pencil-alt"></i></a>
            </div>
        </div>
        @endforeach
    </div>
</main>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ url('/store/todo') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add To Do List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input name="name" class="cust-form-control" id="exampleFormControlInput1"
                            placeholder="Insert your to do list here">
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

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
    function editItem(id) {
        const formTodolist = document.getElementById("item-" + id);
        formTodolist.addEventListener("keydown", (event) => {
            var message = $("textarea").val();
            console.log(message);
            if (event.which == 13) {
                $('#form-update-' + id).submit();
            }
            return false;
        });
    }

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });

</script>
@endsection
