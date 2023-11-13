<?php

namespace App\Http\Controllers;

use App\Models\JournalNew;
use App\Models\User;
use App\Services\JournalNewService;
use App\Http\Requests\JournalNewRequest;
use App\Http\Requests\JournalNewStoreRequest;
use App\Http\Requests\JournalNewUpdateRequest;
use Illuminate\Http\Request;
use JsValidator;
use Auth;

class JournalNewController extends Controller
{

    private $service;
    private $label;

    public function __construct(JournalNewService $service)
    {

        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type,User $user)
    {

        if($type == 'self'){
            $user = Auth::user();
        }

        return view('journalnews.index', ['data' => $this->service->paginate(15,$user),
                                          'user' => $user,
                                          'type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
       
        $validatorRequest = new JournalNewStoreRequest();
        $validator = JsValidator::make($validatorRequest->rules(),$validatorRequest->messages());

        return view('journalnews.form')
            ->with([
                'validator' => $validator,
                'user' => $user
             ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        
        $journalNew = $this->service->create(request()->all(),$user);

        return redirect()->route('journalnew.index',['type' => 'management','user' => $user])
            ->with([
                'data' => $this->service->paginate(15,$user),
                'message' => 'Noticia criada com sucesso',
                'messageType' => 's',
             ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JournalNew  $journalNew
     * @return \Illuminate\Http\Response
     */
    public function show(JournalNew $journalNew)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JournalNew  $journalNew
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, JournalNew $journalNew)
    {
        $validatorRequest = new JournalNewUpdateRequest();
        $validator = JsValidator::make($validatorRequest->rules(),$validatorRequest->messages());

        return view('journalnews.form')
        ->with([
            'validator' => $validator,
            'journalNew' => $journalNew,
            'user' => $user
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JournalNew  $journalNew
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, JournalNew $journalNew)
    {
        $journalNew = $this->service->update(request()->all(),$journalNew,$user);

        return redirect()->route('journalnew.index',['type' => 'management','user' => $user])
            ->with([
                'data' => $this->service->paginate(15,$user),
                'message' => 'Atualizado com sucesso',
                'messageType' => 's',
             ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JournalNew  $journalNew
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, JournalNew $journalNew)
    {
        
        $journalNew = $this->service->delete($journalNew);

        return redirect()->route('journalnew.index',['type' => 'management','user' => $user])
            ->with([
                'data' => $this->service->paginate(15,$user),
                'message' => 'Excluido com sucesso',
                'messageType' => 's',
             ]);
    }
}
