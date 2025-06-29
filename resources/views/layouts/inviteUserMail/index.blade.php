<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hi {{ $maildata['name'] }}</h1>
    <h3>Your Email: {{ $maildata['email'] }}</h3>
    <h3>Your Password: {{ $maildata['password'] }}</h3>
    <a href="{{ route('invitations.edit' , $maildata['id']) }}">Request Pending</a>
</body>
</html>
