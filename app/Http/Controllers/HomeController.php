<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Auth;
use App\Models\Favorite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($message = null)
    {
        $user = Auth::user();
        $response = Http::get("https://pokeapi.co/api/v2/pokemon");
        $pokemonList = $response->json();
        $pokemonList = $pokemonList['results'];
        for ($i = 0; $i < count($pokemonList); $i++) {
            $id = Str::afterLast(rtrim($pokemonList[$i]['url'], '/'), '/');
            $pokemonList[$i]['id'] = $id;
            $favorite = Favorite::where(['id_usuario'=>$user->id, 'ref_api'=>$id])->first();
            $pokemonList[$i]['favorite'] = (!is_null($favorite)) ? 'SI' : 'NO';
        }

        return view('home', compact(['pokemonList', 'message']));
    }

    public function show($id)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . $id);
        $pokemon = $response->json();

        return view('pokemon', compact('pokemon'));
    }

    public function setFavorite($id)
    {
        $user = Auth::user();
        $apiReference = Favorite::where('ref_api', $id)->first();
        if (! is_null($apiReference)) {
            return self::index('El pokemon ya se encuentra como favorito');
        }
        $apiReference = new Favorite(['id_usuario' => $user->id, 'ref_api' => $id]);
        $apiReference->save();
        return self::index('El pokemon se asignó como favorito');
    }
    
}
