<!DOCTYPE html>
<html>
<head>
    <title>Lista de Posts</title>
</head>
<body>

<h1>Lista de Posts</h1>

@if(isset($error))
    <p>{{ $error }}</p>
@else
    @foreach($posts as $post)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h2>Post ID: {{ $post['id'] }}</h2>
            <p>User ID: {{ $post['userId'] }}</p>
            <p>Title: {{ $post['title'] }}</p>
            <p>Body: {{ $post['body'] }}</p>
        </div>
    @endforeach
@endif

</body>
</html>
