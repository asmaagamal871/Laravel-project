@extends('layouts.app')
@section('content')
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                @if ($user->image)
                    <img class="profile-user-img img-fluid img-circle" src="{{ Storage::url($user->image) }}" width="250px"
                        height="500px" alt="{{ $user->image }}">
                @endif

            </div>

            <h3 class="profile-username text-center">{{ $user->type->name }}</h3>

            <p class="text-muted text-center">{{ $user->national_id }}</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{ $user->mob_num }}</a>
                </li>
                <li class="list-group-item">
                    {{-- @foreach ($addresses as $address)
          <b>address</b> <a class="float-right">{{-- --}}</a>
                    {{-- @endforeach --}} 

                </li>
                <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                </li>
            </ul>

            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-block"><b>Edit</b></a>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
