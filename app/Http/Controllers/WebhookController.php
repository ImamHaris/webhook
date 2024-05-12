<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;

class WebhookController extends Controller
{
    public function generateRandomUser()
    {
        $client = new Client();
        $response = $client->get('https://randomuser.me/api/');
        $userData = json_decode($response->getBody()->getContents(), true);

        // Process the user data as needed
        $user = $this->createUser($userData['results'][0]);
        return response()->json($user);
    }

    public function handleExternalUser(Request $request)
    {
        // Handle the incoming external user data
        $externalUserData = $request->all();

        // Process the external user data as needed
        $user = $this->createUser($externalUserData);

        return response()->json(['message' => 'External user data handled successfully']);
    }

    private function createUser($userData)
    {
        $user = new User();
        $user->name = $userData['name']['first'];
        $user->email = $userData['email'];
        $user->password = $userData['login']['password'];
        
        $user->save();

        return $user;
    }

}
