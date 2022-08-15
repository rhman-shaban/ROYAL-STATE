<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscribe Email</title>
</head>
<body>
    {!! clean($template) !!}
    <a href="{{ route('subscription.verify',$subscribe->verify_token) }}">{{ $subscribe->verify_token }}</a>
</body>
</html>
