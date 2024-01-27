<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login V14</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
        <form method="POST" action="/login" class="login100-form validate-form flex-sb flex-w">
          {{ csrf_field() }}

          @if ($errors->any())
          <div class="alert alert-danger"  style="margin: auto;">
            <h4 style="color: red">Заполните корректно</h4><br>
          </div>
          @endif

          @if($message = Session::get('error'))
          <div class="alert alert-danger"  style="margin: auto;">
            <h4 style="color: red">{{ $message }}</h4><br>
          </div>
          @endif

          <span class="login100-form-title p-b-32" style="text-align: center">
            Войти
          </span>

          <span class="txt1 p-b-11">
            Имя
          </span>
          <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
            <input class="input100" type="text" name="name" >
            <span class="focus-input100"></span>
          </div>
          
          <span class="txt1 p-b-11">
            Пароль
          </span>
          <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
            <span class="btn-show-pass">
              <i class="fa fa-eye"></i>
            </span>
            <input class="input100" type="password" name="password" >
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" style="margin: auto;">
              Login
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
</body>
</html>