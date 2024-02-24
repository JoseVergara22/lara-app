<!DOCTYPE html>
<html>
<head>
    <title>User Albums</title>
</head>
<body>

<h1>Albums de cada usuario (ID:{{ $userId }} nombre: {{$username}} )</h1>

@if(isset($error))
    <p>{{ $error }}</p>
@else
    @if(count($userAlbums) > 0)
        @foreach($userAlbums as $album)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h2>Album ID: {{ $album['id'] }}</h2>
                <p>Title: {{ $album['title'] }}</p>
            </div>
        @endforeach
    @else
        <p>No se encuentran albun de este usuario.</p>
    @endif
@endif

</body>
</html>
