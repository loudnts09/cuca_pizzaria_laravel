<?php

namespace App\Http\Controllers;

use App\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [

            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nome' => 'required|min:3|max:200',
            'email' => 'required|min:8|max:200',
            'senha' => 'required|min:3|max:20',
            'cpf' => 'required|min:11|max:14',
            'telefone' => 'required|min:8|max:20',
            'perfil_id' => 'required'
        ];

        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'foto.mimes' => 'O campo :attribute apenas recebe arquivos do tipo: jpeg, jpg, png, gif e svg.',
            'foto.max' => 'A imagem deve possuir no máximo 2MB.',
            'nome.min' => 'A quantidade mínima de caracteres é 3.',
            'nome.max' => 'A quantidade máxima de caracteres é 200.',
            'email.min' => 'A quantidade mínima de caracteres é 8.',
            'email.max' => 'A quantidade máxima de caracteres é 200.',
            'cpf.min' => 'A quantidade mínima de caracteres é 11.',
            'cpf.max' => 'A quantidade máxima de caracteres é 14.',
            'telefone.min' => 'A quantidade mínima de caracteres é 8.',
            'telefone.max' => 'A quantidade máxima de caracteres é 20.',
        ];

        
        $request->validate($regras, $feedbacks);
        
        if($request->hasFile('foto')){
            $caminhoFoto = $request->file('foto')->store('fotos', 'public');
            $request->merge(['foto' => $caminhoFoto]);
        }

        Pessoa::create($request->all());

        //return redirect()->route('site.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
