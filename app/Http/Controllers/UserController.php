<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::select('id', 'name', 'email')->paginate('2');

        return [
            'status' => 200,
            'menssagem' => 'Usuários encontrados!!',
            'user' => $user
        ];
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'menssagem' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    public function show(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => $user
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário encontrado!!',
            'user' => $user
        ];
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $data = $request->all();

        $user = User::find($id);

        if(!$user){
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => $user
            ];
        }

        $user->update($data);

        return [
            'status' => 200,
            'message' => 'Usuário atualizado!!',
            'user' => $user
        ];
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado!',
                'user' => $user
            ];
        }

        $user->delete($id);

        return [
            'status' => 200,
            'message' => 'Usuário deletado!!'
        ];

    }
}
