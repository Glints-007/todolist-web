<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="d-flex align-items-center mb-4">
            <div class="add-btn">
                <form>
                    <a data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a>
                </form>
            </div>
            <h1 class="w-100 heading-text">To Do List</h1>
        </div>
        <div class="container box-container">
            <div class="box">
                <form action="">
                    <textarea type="text" class="box__input" id="submitTodolist"
                        onsubmit="alert('SUBMITED')"></textarea>
                </form>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add To Do List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="cust-form-control" id="exampleFormControlInput1"
                                placeholder="Insert your to do list here">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Date</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1"
                                placeholder="Due date">
                        </div>

                        <!-- <div class="form-group" style="padding: 10px;">
                  <div class="mb-4">
                      <a onclick="alert('Add subtask')" style="cursor: pointer;">
                          <i class="fas fa-plus mr-2"></i>Add Subtask
                      </a>
                  </div>
                  <div class="sub-task">First subtask</div>
                  <div class="sub-task">Second subtask</div>
                  <div class="sub-task">Third subtask</div>
              </div> -->

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>Add Description:</strong></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="flex justify-center col-lg-8">
                    <h1>To Do App</h1>
                    <a href="{{url('create/todo')}}" class="btn btn-primary"> Add Todo</a>
                </div>

                <div class="col-lg-8 mt-5">
                    <table class="table-bordered">
                        <tr>
                            <!-- <th>Id</th>
                            <th>User Id</th> -->
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($data as $dataTodo)
                        <tr>
                            <!-- <td>{{ $dataTodo->id }}</td>
                                <td>{{ $dataTodo->userId }}</td> -->
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
        // function addBox(){
        //     const boxContainer = document.getElementsByClassName("box-container")[0];
        //     const newDiv = document.createElement("div");
        //     newDiv.className = "box";
        //     newDiv.innerHTML = `
        //       <form action="">
        //         <textarea type="text" class="box__input" id="submitTodolist" onsubmit="alert('SUBMITED')"></textarea>
        //       </form>`;
        //     boxContainer.appendChild(newDiv);
        // }

        $(document).ready(function () {
            $('#submitTodolist').keypress(function (e) {
                if (e.which == 13) {
                    // submit via ajax or
                    $('form').submit();
                }
            });
        });

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });

    </script>
</x-app-layout>
