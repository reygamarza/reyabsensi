<!DOCTYPE HTML>
<html lang="en" >
<html>
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{{asset ("assets/siswa")}}/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body class="body">
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <div class="logo">
        <img src="{{asset ("assets/siswa")}}/assets/img/logoabas1.png" alt="logoabas" width="150px">
      </div>

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="{{asset ("assets/siswa")}}/assets/img/man.png" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input id="identifier" type="text" class="form-control @error('identifier') is-invalid @enderror fadeIn second" name="identifier" value="{{ old('identifier') }}" required autocomplete="identifier" autofocus placeholder="Username">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror fadeIn third" name="password" required autocomplete="current-password" placeholder="Password">
        <input type="submit" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <!-- <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div> -->

    </div>
  </div>
</body>
</html>

