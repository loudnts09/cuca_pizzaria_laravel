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
        return view('app.cadastro.create');
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

            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nome' => 'required|min:3|max:200'
            // 'email' => 'required|min:8|max:200',
            // 'senha' => 'required|min:3|max:20',
            // 'cpf' => 'required|min:11|max:14',
            // 'telefone' => 'required|min:8|max:20',
            // 'perfil_id' => 'required'
        ];

        $feedbacks = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'foto.mimes' => 'O campo :attribute apenas recebe arquivos do tipo: jpeg, jpg, png, gif e svg.',
            'foto.max' => 'A imagem deve possuir no máximo 2MB.',
            'nome.min' => 'A quantidade mínima de caracteres é 3.',
            'nome.max' => 'A quantidade máxima de caracteres é 200.',
            'email.min' => 'A quantidade mínima de caracteres é 8.',
            'email.max' => 'A quantidade máxima de caracteres é 200.',
            'senha.min' => 'A quantidade mínima é de 3 caracteres',
            'senha.max' => 'A quantidade máxima é de 20 caracteres',
            'cpf.min' => 'A quantidade mínima de caracteres é 11.',
            'cpf.max' => 'A quantidade máxima de caracteres é 14.',
            'telefone.min' => 'A quantidade mínima de caracteres é 8.',
            'telefone.max' => 'A quantidade máxima de caracteres é 20.',
        ]; 

        
        dd($request->all());
        try {
            //code...
            $request->validate($regras, $feedbacks);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
        
        if($request->hasFile('foto')){
            $caminhoFoto = $request->file('foto')->store('fotos', 'public');
            $request->merge(['foto' => $caminhoFoto]);
        }
        
        try {
            // dd($request->all());
            Pessoa::create($request->all());
            return redirect()->route('site.login')->with('mensagem', 'Cadastro realizado com sucesso!');

        } catch (\Exception $erro){
            return back()->withInput()->withErrors('Falha ao realizar cadastro');

        }
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
