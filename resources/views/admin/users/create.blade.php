@extends('admin.users.layout', [
    'title' => ( $title ?? 'Quản lý tài khoản' )
])

@section('content')
<form action="/admin/store" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email"id="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="phone">Mobile phone</label>
        <input type="text" class="form-control" name="phone"id="phone" aria-describedby="phone" placeholder="Enter mobile phone">
    </div>
    <div class="form-group">
        <label for="new_password">Password</label>
        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="new_password_confirmation">Re-enter password</label>
        <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Tạo</button>
</form>
@endsection
