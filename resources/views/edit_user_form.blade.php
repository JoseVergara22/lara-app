<!DOCTYPE html>
<html>
<head>
    <title>Editar User</title>
</head>
<body>

<h1>Editar Usuario</h1>

@if(isset($error))
    <p>{{ $error }}</p>
@else
    <form method="post" action="{{ route('update.user', ['userId' => $user['id']]) }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" value="{{ $user['name'] }}"><br>

        <label>Username:</label>
        <input type="text" name="username" value="{{ $user['username'] }}"><br>

        <label>Email:</label>
        <input type="text" name="email" value="{{ $user['email'] }}"><br>

        <label>Street:</label>
        <input type="text" name="street" value="{{ $user['address']['street'] }}"><br>

        <label>Suite:</label>
        <input type="text" name="suite" value="{{ $user['address']['suite'] }}"><br>

        <label>City:</label>
        <input type="text" name="city" value="{{ $user['address']['city'] }}"><br>

        <label>Zipcode:</label>
        <input type="text" name="zipcode" value="{{ $user['address']['zipcode'] }}"><br>

        <label>Latitude:</label>
        <input type="text" name="lat" value="{{ $user['address']['geo']['lat'] }}"><br>

        <label>Longitude:</label>
        <input type="text" name="lng" value="{{ $user['address']['geo']['lng'] }}"><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="{{ $user['phone'] }}"><br>

        <label>Website:</label>
        <input type="text" name="website" value="{{ $user['website'] }}"><br>

        <label>Company Name:</label>
        <input type="text" name="company_name" value="{{ $user['company']['name'] }}"><br>

        <label>CatchPhrase:</label>
        <input type="text" name="catchPhrase" value="{{ $user['company']['catchPhrase'] }}"><br>

        <label>BS:</label>
        <input type="text" name="bs" value="{{ $user['company']['bs'] }}"><br>

        <button type="submit">Guardar cambios</button>
    </form>
@endif

</body>
</html>
       
