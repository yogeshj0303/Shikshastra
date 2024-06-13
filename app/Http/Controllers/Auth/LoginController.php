<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Add this line
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request) // Add the Request parameter
    {
        $user = Socialite::driver('google')->user();

        // Check if the user exists in your application's database
        $existingUser = User::where('email', $user->email)->first();
   
        if ($existingUser) {
            // Log in the existing user
             $request->session()->put('userlogin', true);
                $request->session()->put('user_id', $existingUser->id);
                $request->session()->put('user_name', $existingUser->fname);
                $request->session()->put('user_email', $existingUser->email);
                $request->session()->put('sub_status', $existingUser->sub_status);
            Auth::login($existingUser);
        } else {
            // Create a new user and log them in
            $newUser = new User();
            $newUser->fname = $user->user['given_name'];
            $newUser->lname = $user->user['family_name'];
            $newUser->image = $user->user['picture'];
            $newUser->email = $user->email;
            
            if ($newUser->save()) {
                // After saving, retrieve the user with their ID
                $newUser = User::find($newUser->id);

                // Store user data in the session
                $request->session()->put('userlogin', true);
                $request->session()->put('user_id', $newUser->id);
                $request->session()->put('user_name', $newUser->fname);
                $request->session()->put('user_email', $newUser->email);
                $request->session()->put('sub_status', $newUser->sub_status);

                // Log in the new user
                Auth::login($newUser);
            }
        }
        return redirect('/')->with('success', 'Login successfully'); // Redirect to the home page or any desired route
    }
    
    // linkedin
    
    
  public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->scopes(['email', 'profile','openid'])->redirect();
    }
    
  public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
     public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
