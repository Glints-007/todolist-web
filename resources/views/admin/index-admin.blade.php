@extends('layouts.admin')

@section('content')
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Name
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Log Out</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- <div class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center fw-bold" href="#">to.do admin</a>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <li class="dropdown px-3">
                <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Name
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Log Out</a></li>
                </ul>
            </li>
        </div>
    </div>
</div> -->

<div class="container my-md-4">
    <h5>Data User</h5>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>abc</td>
                                <td>abc@abc.com</td>
                                <td>
                                    <button type="button" class="btn btn-warning"data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End of Table -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label"></label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>

@endsection