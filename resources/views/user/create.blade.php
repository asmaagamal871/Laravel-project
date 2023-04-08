@extends('layouts.app')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create new User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    @error('name')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="national_id">National ID</label>
                    <input type="text" class="form-control" id="national_id" placeholder="Namtional ID"
                        name="national_id">
                    @error('national_id')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="email" name="email">
                    @error('email')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone" name="mob_num">
                    @error('mob_num')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                        name="password">
                    @error('password')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="DOB">Date Of Birth</label>
                    <div class="input-group">

                        <input type="date" class="form-control" data-inputmask-alias="datetime"
                            data-inputmask-inputformat="dd/mm/yyyy" data-mask name="DOB">
                            @error('DOB')
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                {{-- GENDERRRRR --}}
                <div class="form-group">
                    <label for="radio1">Gender</label>
                    <div class="d-flex ">
                        <div class="form-check pr-4">
                            <input class="form-check-input " type="radio" name="gender" value="female">
                            <label class="form-check-label">Female</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male">
                            <label class="form-check-label">Male</label>
                        </div>
                    </div>
                    @error('gender')
                        <div class="alert alert-danger my-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">avatar</label>
                    <input type="file" name="image" accept=".jpg,.png" class="form-control">

                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
