@extends('layouts.admin')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container container-fluid">
        <a class="navbar-brand fw-bold" href="">to.do admin</a>
        <div class="d-flex">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a></li>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- End of Navbar -->

<!-- Main -->
<div class="container my-md-4">
    <h5 class="fw-bold"><i class="fas fa-user-circle"></i> Data User</h5>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-hover" id="data-table">
                        <meta name="csrf-token-delete" content="{{ csrf_token() }}">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($data_user as $user)
                        <tbody>
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning"data-bs-toggle="modal" data-bs-target="#editModal{{$user->id}}">Edit</button>
                                    <button type="button" class="btn btn-danger deleteuser" data-id="{{$user->id}}" data-url="{{ route('index-admin.destroy', $user->id) }}">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <!-- End of Table -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach($data_user as $user)
<div class="modal fade" id="editModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <meta name="csrf-token-edit" content="{{ csrf_token() }}">
            <div class="mb-3">
                <label class="form-label">Name :</label>
                <input type="text" class="form-control" id="name_edit{{$user->id}}" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address :</label>
                <input type="email" class="form-control" id="email_edit{{$user->id}}" value="{{$user->email}}">
            </div>
            <div class="form-group">
            <label for="password">New Password :</label>
            <input type="password" class="form-control" id="password_edit{{$user->id}}" name="password" required autocomplete="off">
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary edituser" data-oldname="{{$user->name}}"  data-oldemail="{{$user->email}}" data-oldpassword="{{$user->password}}" data-id="{{$user->id}}" data-url="{{ route('index-admin.update', $user->id) }}">Save changes</button>
        </div>
        </div>
    </div>
</div>
@endforeach

@endsection