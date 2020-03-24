<!DOCTYPE html>
<html>
  <head>
    <title>MakerIndo Academy</title>
  </head>
  <body>
    <h2>Hello {{$user['name']}}</h2>
    <br/>
    Your registered email is {{$user['email']}} , Here is your new password : {{ $user['password'] }}    
    <br/>
    <a href="{{url('/login')}}">Login here</a>
  </body>
</html>
