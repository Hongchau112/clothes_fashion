@extends('admin.users.layout', [
    'title' => ( $title ?? 'Quản lý tài khoản' )
])

@section('content')
    <form action="/admin/update/{{$user->id}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="{{$user->name}}" name="name" id="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" value="{{$user->email}}" name="email"id="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="phone" >Mobile Phone</label>
            <input type="text" class="form-control" value="{{$user->phone}}" name="phone" id="phone" placeholder="Mobile phone">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

