<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function show($email)
    {
        return User::where('email', $email)->get();
    }
    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    // NO SE PUEDEN CREAR USUARIOS
    public function store(Request $request)
    {

      //$user = User::where([['email' , $request->user],['password', Hash::make($request->password)]])->get();
      //$user = User::whereEmail($request->user)->wherePassword(Hash::make($request->password))->first();
      //$user = User::whereName($request->user)->wherePassword(Hash::make($request->password))->first();
      $credentials = array(
            'name' => $request->input('user'),
            'password' => $request->input('password')
        );
        $user = User::where('name',$request->name)->get();
    $resultado = [];
    $resultado['valido'] = Auth::attempt($credentials);
    $resultado['id'] = $user[0]->id;
    $resultado['email'] = $user[0]->email;
    //   if (Auth::attempt($credentials))
    //   {
    //     return response()->json(Auth::attempt($credentials), 201);
    //   }
    //   else{
    //     return response()->json('No funciona', 201);
    //   }

    return response()->json($resultado, 200);
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        if ($user->id == 1) {
            return redirect()->route('user.index');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->update($request->all());

        return response()->json($user, 200);

    }

    public function updateDash(UserRequest $request, User  $user)
    {
        $hasPassword = $request->get('password');
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except(
                    [$hasPassword ? '' : 'password']
                )
        );

        return redirect()->route('user.index')->withStatus(__('user.updated'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        if ($user->id == 1) {
            return abort(403);
        }

        // delete user's avatar
        $image = public_path() . '/black/img/' . $user->avatar;
        if (File::exists($image)) {
            File::delete($image);
        }

        $user->delete();

        return redirect()->route('user.index')->withStatus(__('web.user-deleted'));
    }
}
