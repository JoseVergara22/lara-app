<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
</head>
<body>

<h1>Lista de Usuarios</h1>

@if(isset($error))
    <p>{{ $error }}</p>
@else
    @foreach($users as $user)
        <h2>{{ $user['name'] }}</h2>
        <p>User ID: {{ $user['id'] }}</p>
        <p>Username: {{ $user['username'] }}</p>
        <p>Email: {{ $user['email'] }}</p>
        <p>Address: {{ $user['address']['street'] }}, {{ $user['address']['suite'] }}, {{ $user['address']['city'] }}, {{ $user['address']['zipcode'] }}</p>
        <p>Geo: {{ $user['address']['geo']['lat'] }}, {{ $user['address']['geo']['lng'] }}</p>

        <!-- formulario para enviar la solicitud DELETE -->
        <form method="post" action="{{ route('delete.user', ['userId' => $user['id']]) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>

        <hr>
    @endforeach

        <!-- Mostrar mensaje de error si ocurrió un problema al eliminar el usuario -->
    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
@endif

</body>
</html>
