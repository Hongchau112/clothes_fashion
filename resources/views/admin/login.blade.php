ĐĂNG NHẬP

<form method="POST" action="/admin/login">
@csrf
<h1>Login form</h1>

    <input type="text" class='form-control' name ="name" placeholder= "Username" required /><br><br>
    <input type="password" class='form-control' name ="password" placeholder= "Password" required /><br><br>
    <input type="submit" value="Login">

</form>
