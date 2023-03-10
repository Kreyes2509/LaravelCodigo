<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Mail\MandarCorreo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dashboard()
    {
        return view('Auth.dashboard');
    }

    public function registrarView()
    {
        return view('Auth.registrar');
    }

    public function loginView()
    {
        return view('Auth.login');
    }

    public function CodeView(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }
        return view('mail.verificarCodigo');
    }


    public function Login(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validacion->fails())
        {
            return redirect('/login')->with('msg','credenciales no validas');
        }
        $user = User::where("email", "=", $request->email)->first();
        $codigo = rand(1000,10000);
        $id = $user->id;
        $url=URL::temporarySignedRoute('CodeView', now()->addMinutes(1),['id'=>$user->id]);

        self::updateUser($user->id,$codigo);

        Mail::to($request->email)->send(new MandarCorreo($user,$codigo,$url));
        return redirect('/login')->with('msg','Te enviamos un codigo de verificacion a tu correo');


    }

    public function Registrar(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $user->password = $password;
        $user->save();

        if($user->save()){
            return redirect('/login')->with('msg','Bienvenido!');
        }

        return redirect('/registrar')->with('msg','datos no validos');
    }


    public function cerrarSesion() {
        Session::flush();
        Auth::logout();

        return redirect('/login');
    }

    public function updateUser($id,$codigo)
    {
        $user = User::find($id);
        $user->codigo_correo = $codigo;
        $user->save();
    }
}
