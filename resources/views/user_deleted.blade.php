<!DOCTYPE html>
<html>
<head>
    <title>Usuario Eliminado</title>
</head>
<body>

<h1>Usuario Eliminado</h1>

@if(isset($message))
    <p>{{ $message }}</p>
@else
    @if(isset($error))
        <p>Error: {{ $error }}</p>
    @else
        <p>Algo salió mal.</p>
    @endif
@endif

</body>
</html>
