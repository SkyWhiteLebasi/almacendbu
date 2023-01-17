<?php

namespace App\Http\Controllers;

use App\Models\User;

use laravelcollective\html;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user.index')->only('index');
        $this->middleware('can:user.create')->only('create','store');
        $this->middleware('can:user.edit')->only('edit','update');
        $this->middleware('can:user.destroy')->only('destroy');

    }
    public function index()
    {
        $datos['users']=User::all()->sortDesc();
        $num=1;
        return view('user.index', $datos,compact('num'));
    }

   
    public function create()
    {
        return view('user.create');
    }

   
    public function store(Request $request)
    {
        User::create($request->only('name', 'email') 
        + [
            'password' => bcrypt($request->input('password')),
        ]);
    
        
        return redirect('user')->with('guardar', 'ok');
    }

    public function show($id)
    {

    }

    
    public function edit(User $user)
    {
        $roles=ModelsRole::all();

        return view('user.edit', compact('user', 'roles'));
    }

    
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect('user')->with('asignar', 'ok');
    }

    
    public function destroy($id)
    {
        $user=User::findOrFail($id);

        User::destroy($id);
        return redirect('user')->with('eliminar', 'ok');
    }
}
