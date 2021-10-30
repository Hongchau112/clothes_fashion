
<!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {font-family: Arial, Helvetica, sans-serif; width: 50%;  margin-left: 330px; background-image: url({{asset("/dashlite/images/avatar/bg2.png")}});}
            form { margin: 40px;}
            /*border: 2px solid #f1f1f1;*/

            input[type=text], input[type=password] {
                width: 80%;
                padding: 12px 20px;
                margin: 5px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            button{
                background-color: #04AA6D;
                color: white;
                padding: 14px 20px;
                margin-bottom: 40px;
                border: none;
                cursor: pointer;
                border-radius: 12px;
                margin-left: 150px;
            }

            button:hover {
                opacity: 0.8;
            }

            .imgcontainer {
                text-align: center;
                margin: 24px 0 12px 0;
            }

            img.avatar {
                width: 40%;
                border-radius: 50%;
            }

            .container {
                margin-left: 110px;
            }

            span.psw {
                float: right;
                padding-top: 16px;
            }
            label {
                margin-right: 25px;
            }

            /* Change styles for span and cancel button on extra small screens */
        </style>
    </head>
    <body>
        <form action="{{route('admin.login')}}" method="POST">
            @csrf
            <h1 style="text-align: center;">Đăng nhập</h1>
            <div class="imgcontainer">
                <img src="{{asset('/dashlite/images/avatar/avatar.jpg')}}" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <label for="uname"><b>Username</b></label><br>
                <input type="text" class='form-control' name ="name" placeholder= "Username" required /><br><br>

                <label for="psw"><b>Password</b></label><br>
                <input type="password" class='form-control' name ="password" placeholder= "Password" required /><br><br>
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
    </body>
</html>
