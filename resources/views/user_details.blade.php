<!DOCTYPE html>
<html>
<head>
    <title>Detalles de usuario</title>
</head>
<body>

<h1>Detalles de usuario</h1>

@if(isset($error))
    <p>{{ $error }}</p>
@else
    <!-- Mostrar detalles actualizados del usuario si están disponibles -->
    @if(session('editedUser'))
        @php
            $user = session('editedUser');
        @endphp
    @endif

    <p>Name: {{ $user['name'] }}</p>
    <p>Username: {{ $user['username'] }}</p>
    <p>Email: {{ $user['email'] }}</p>
    
@endif

</body>
</html>
