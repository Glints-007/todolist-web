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
    
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="flex justify-center col-lg-8" >
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
</x-app-layout>
