<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Temperature;
use Illuminate\Support\Facades\Http;
use Config;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (\Auth::attempt($credentials)) {

            $city1_lat = Config::get('cities.CITY1_LAT');
            $city1_lon = Config::get('cities.CITY1_LON');
            $city2_lat = Config::get('cities.CITY2_LAT');
            $city2_lon = Config::get('cities.CITY2_LON');
            $api_key = Config::get('cities.API_KEY');

            $colombo = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$city1_lat}&lon={$city1_lon}&exclude=&appid={$api_key}&units=metric");
            $melbourne = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$city2_lat}&lon={$city2_lon}&exclude=&appid={$api_key}&units=metric");

            Temperature::create([
                'user_id' => \Auth::id(),
                'logged_in_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'city1_temperature' => $colombo->json()['current']['temp'],
                'city2_temperature' => $melbourne->json()['current']['temp']
            ]);

            return redirect()->intended('dashboard');
        }
  
        return redirect('/login')->with('message', 'Oppes! You have entered invalid credentials');
    } 
}
