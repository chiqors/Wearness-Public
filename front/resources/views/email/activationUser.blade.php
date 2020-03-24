@php
    use App\AppSetting;

    $app = AppSetting::first();
@endphp

<!DOCTYPE html>
<html>
  <head>
    <title>{{ $app->name }}</title>
  </head>
  <body>
    <h2>Welcome to {{ $app->name }} {{$user['name']}}</h2>
    <br/>
    Your registered email is {{$user['email']}} , Please click on the below link to verify your account
    <br/>
    <a href="{{url('user/verify', $user->verifyUser->token)}}">Verify Email</a>
  </body>
</html>
