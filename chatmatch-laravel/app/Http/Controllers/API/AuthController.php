<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class AuthController extends Controller
{
    use HasApiTokens, Notifiable;
    public function register(Request $request)
    {

        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'pseudo' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'max:255', RulesPassword::min(8)->numbers(), RulesPassword::min(8)->mixedCase(), RulesPassword::min(8)->letters()],               //Password::min(8)->symbols(),

        ]);

        $user = User::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // $idconnecte=$user['id'];



        $token = $user->createToken('auth_token')->plainTextToken;

        $user->remember_token = $token;
        $user->save();
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|same:password',

        ]);

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user['password']) === false) {

            $token = $user->createToken('auth_token')->plainTextToken;

            $user->remember_token = $token;
            $user->save();


            return response()->json([
                'message' => "Vous êtes connecté.",
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 201);
        } else {
            return response()->json([
                'message' => "Identifiant ou mot de passe incorect",

            ], 400);
        }
    }

    public function edit()
    {
        $profil = User::findOrFail(Auth::user()->id);

        return response()->json(['profil' => $profil]);
    }

    public function update(Request $request)
    {

        $request->validate([

            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'pseudo' => 'required|string',
            'email' => 'required|email',
            'password' => ['required', 'string', 'max:255', RulesPassword::min(8)->numbers(), RulesPassword::min(8)->mixedCase(), RulesPassword::min(8)->letters()],
        ]);

        $profil = User::findOrFail(Auth::user()->id);
        $profil->lastname = $request->lastname;
        $profil->firstname = $request->firstname;
        $profil->pseudo = $request->pseudo;
        $profil->email = $request->email;
        $profil->password = Hash::make($request->password);

        $profil->save();

        return response()->json(['message' => "Profil modifié.", 'profil' => $profil], 201);
    }
}
