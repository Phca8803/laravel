<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use JsValidator;

class UserController extends Controller
{


    private $service;
    private $label;

    public function __construct(UserService $service)
    {

        $this->service = $service;
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $user)
    {
        return view('users.index', ['data' => $user->paginate(15)]);
    }

    public function create(){

        $validatorRequest = new UserStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(),$validatorRequest->messages());

        return view('users.form')
            ->with([
                'validator' => $validator,
             ]);
    }

    public function store(){

        $user = $this->service->create(request()->all());

        return view('user.index')
            ->with([
                'data' => $user->paginate(15),
                'message' => 'Criado com sucesso',
                'messageType' => 's',
             ]);

    }

    public function edit(User $user){

        $validatorRequest = new UserUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(),$validatorRequest->messages());

        return view('users.form')
        ->with([
            'validator' => $validator,
            'user' => $user
         ]);

    }

    public function update(User $user){
        
        $user = $this->service->update(request()->all(),$user);

        return view('users.index')
            ->with([
                'data' => $user->paginate(15),
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
             ]);

    }

    public function destroy(User $user){

        $user = $this->service->delete($user);

        return view('users.index')
            ->with([
                'data' => $user->paginate(15),
                'message' => 'Excluido com sucesso',
                'messageType' => 's',
             ]);
    }

    
}
