<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $userData = $request->only(['name', 'last_name', 'email', 'phone']);
        $userData['password'] = bcrypt($request->input('password'));

        $user = User::create($userData);

        if ($request->hasFile('photo')) {
            $user->addMediaFromRequest('photo')->toMediaCollection('userGallery');
        }

        return redirect()->back()->with('success', 'Usuario creado exitosamente');
    }


    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('nameUpdate');
            $user->last_name = $request->input('lastNameUpdate');
            $user->phone = $request->input('phoneUpdate');
            $user->email = $request->input('emailUpdate');

            $user->save();

            if ($request->hasFile('photo')) {
                $user->clearMediaCollection('userGallery');
                $user->addMediaFromRequest('photo')->toMediaCollection('userGallery');
            }

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        }

        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Hubo un problema al eliminar el usuario.');
        }
    }
}
