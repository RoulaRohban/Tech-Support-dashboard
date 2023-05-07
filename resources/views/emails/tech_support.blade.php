<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Technical Support APPA</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<h1>New Tech Support under {{ $support->category->name }} Category</h1>
<p>Title: {{ $support->title }}.</p>
<p>Description: {{ $support->description }}.</p>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
</body>
</html>
