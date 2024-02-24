<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Http;
use App\Models\RequestLog;

class HomeController extends Controller
{
/// Obtener listado de un usuarios

    public function listUsers()
{
        $client = new Client();

        try {
            $url = 'https://jsonplaceholder.typicode.com/users';
            $response = $client->request('GET', $url);
            $users = json_decode($response->getBody(), true);

             return view('list_users', ['users' => $users]);

        } catch (\Exception $e) {
            return view('list_users', ['error' => 'Error al obtener la lista de usuarios: ' . $e->getMessage()]);
        }
    }
/// Obtener albunes de un usuario
    public function getUserAlbums($userId)
{
    $client = new Client();

    try {
        // Obtener información del usuario
        $userUrl = 'https://jsonplaceholder.typicode.com/users/' . $userId;
        $userResponse = $client->request('GET', $userUrl);
        $userData = json_decode($userResponse->getBody(), true);

        // Obtener todos los álbumes
        $albumsUrl = 'https://jsonplaceholder.typicode.com/albums';
        $albumsResponse = $client->request('GET', $albumsUrl);
        $allAlbums = json_decode($albumsResponse->getBody(), true);

        // Filtrar álbumes por userId
        $userAlbums = array_filter($allAlbums, function ($album) use ($userId) {
            return $album['userId'] == $userId;
        });

        return view('user_albums', [
            'userAlbums' => $userAlbums,
            'userId' => $userId,
            'username' => $userData['username'], 
        ]);

    } catch (\Exception $e) {
        return view('user_albums', ['error' => 'Error al obtener los álbumes del usuario: ' . $e->getMessage()]);
    }
}

    /// mostrar todos los posts
    public function listPosts()
    {
        $client = new Client();

        try {
            $url = 'https://jsonplaceholder.typicode.com/posts';
            $response = $client->request('GET', $url);
            $posts = json_decode($response->getBody(), true);

            return view('list_posts', ['posts' => $posts]);

        } catch (\Exception $e) {
            return view('list_posts', ['error' => 'Error al obtener la lista de posts: ' . $e->getMessage()]);
        }
    }

//// Editar usuarios //////
    public function showEditForm($userId)
    {
        try {
            // Obtener datos del usuario desde la API
            $response = Http::get("https://jsonplaceholder.typicode.com/users/{$userId}");
            $user = $response->json();

            return view('edit_user_form', ['user' => $user]);

        } catch (\Exception $e) {
            return view('edit_user_form', ['error' => 'Error al obtener datos del usuario: ' . $e->getMessage()]);
        }
    }

    public function editUser(Request $request, $userId)
    {
        try {
           
            $editedUser = [
                'id' => $userId,
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'address' => [
                    'street' => $request->input('street'),
                    'suite' => $request->input('suite'),
                    'city' => $request->input('city'),
                    'zipcode' => $request->input('zipcode'),
                    'geo' => [
                        'lat' => $request->input('lat'),
                        'lng' => $request->input('lng'),
                    ],
                ],
                'phone' => $request->input('phone'),
                'website' => $request->input('website'),
                'company' => [
                    'name' => $request->input('company_name'),
                    'catchPhrase' => $request->input('catchPhrase'),
                    'bs' => $request->input('bs'),
                ],
            ];

            // Después de editar, redirigir 
            return redirect()->route('user.details', ['userId' => $userId])->with('editedUser', $editedUser);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al editar el usuario: ' . $e->getMessage());
        }
    }

    public function showUserDetails($userId)
    {
        try {
            // Obtener datos del usuario desde la API
            $response = Http::get("https://jsonplaceholder.typicode.com/users/{$userId}");
            $user = $response->json();

            return view('user_details', ['user' => $user]);

        } catch (\Exception $e) {
            return view('user_details', ['error' => 'Error al obtener datos del usuario: ' . $e->getMessage()]);
        }
    }
/// Eliminar usuario
    public function deleteUser($userId)
    {
        $client = new Client();

        try {
            // Realiza la solicitud DELETE a la API para eliminar el usuario
            $response = $client->request('DELETE', "https://jsonplaceholder.typicode.com/users/{$userId}");

            // Verificacion si la eliminación fue exitosa
            if ($response->getStatusCode() == 200) {
                
                return view('user_deleted')->with('message', 'Usuario eliminado correctamente.');
            } else {
                
                return view('user_deleted')->with('error', 'Error al eliminar el usuario.');
            }
        } catch (\Exception $e) {
            
            return view('user_deleted')->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }


    /// crear listado de solicitudes  
    public function Metodo(Request $request)
    {
        $path = $request->path();
        $method = $request->method();
        $ip = $request->ip();

        // Registrar la información en la base de datos
        RequestLog::create([
            'path' => $path,
            'method' => $method,
            'ip' => $ip,
        ]);
        Log::info('Registro en la base de datos exitoso'); // Agrega esto para registrar información en los logs

        return response()->json(['success' => true]);

        
    }

}



