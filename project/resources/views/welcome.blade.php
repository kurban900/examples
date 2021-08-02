<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <span style="color: red">{{ $error }}</span>
    @endforeach
@endif

@if (session()->has('success'))
    <span style="color:#3c7d16;">{{ session('success') }}</span>
@endif

<div id="import_status"></div>

<form action="{{ route('file.upload') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="file" name="file">
    <button type="submit">Send</button>
</form>


<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
