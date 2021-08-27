<?php

namespace App\Http\Controllers;

use App\Http\Requests\DespesaRequest;
use App\Models\{Despesa, User};
use App\Mail\Despesa as DespesaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Despesa $despesa)
    {
        return response()->json($despesa->with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DespesaRequest $request, Despesa $despesa)
    {
        $despesa = $despesa->create($request->validated());
        $this->email($despesa);
        return response()->json($despesa);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user->with('despesa')->get());
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(DespesaRequest $request, Despesa $despesa)
    {
        $despesa->update($request->validated());
        return response()->json($despesa);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despesa $despesa = null)
    {
        $despesa->delete();
        return response()->json('Nenhuma despesa encontrada.');
    }

    private function email(Despesa $despesa)
    {
        Mail::send('mail', ['despesa' => $despesa->with('user')->first()], function($m) use ($despesa){
            $m->from('onfly.lucas@gmail.com', 'Lucas');
            $m->to('lucas10castellani@gmail.com');
            $m->subject($despesa->user()->first()->email);
        });
    }
}
