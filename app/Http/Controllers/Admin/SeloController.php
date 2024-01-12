<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeloRequest;
use App\Models\Selo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SeloController extends Controller
{
    public function index()
    {
        $selos = Selo::orderBy('created_at', 'DESC')->orderBy('status', 'ASC')->paginate(25);
        return view('admin.selos.index', [
            'selos' => $selos,
        ]);
    }
    
    public function create()
    {
        return view('admin.selos.create');
    }

    public function store(SeloRequest $request)
    {
        $seloCreate = Selo::create($request->all()); 

        $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

        if ($validator->fails() === true) {
            return redirect()->back()->withInput()->with([
                'color' => 'orange',
                'message' => 'Todas as imagens devem ser do tipo jpg, jpeg ou png.',
            ]);
        }

        if(!empty($request->file('imagem'))){
            $seloCreate->imagem = $request->file('imagem')->storeAs(env('AWS_PASTA') . 'selos', Str::slug($request->titulo)  . '-' . str_replace('.', '', microtime(true)) . '.' . $request->file('imagem')->extension());
            $seloCreate->save();
        }

        return redirect()->route('selos.edit', $seloCreate->id)->with(
            [
                'color' => 'success', 
                'message' => 'Selo cadastrado com sucesso!'
            ]);
    }    
    
    public function edit($id)
    {
        $selo = Selo::where('id', $id)->first(); 
        
        return view('admin.selos.edit', [
            'selo' => $selo
        ]);
    }
    
    public function update(SeloRequest $request, $id)
    {
        $selo = Selo::where('id', $id)->first();
        
        $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

        if ($validator->fails() === true) {
            return redirect()->back()->withInput()->with([
                'color' => 'orange',
                'message' => 'Todas as imagens devem ser do tipo jpg, jpeg ou png.',
            ]);
        }

        if(!empty($request->file('imagem'))){
            Storage::delete($selo->imagem);
            $selo->imagem = '';
        }
        
        $selo->fill($request->all());

        if(!empty($request->file('imagem'))){
            $selo->imagem = $request->file('imagem')->storeAs(env('AWS_PASTA') . 'selos', Str::slug($request->titulo)  . '-' . str_replace('.', '', microtime(true)) . '.' . $request->file('imagem')->extension());
        }

        if(!$selo->save()){
            return redirect()->back()->withInput()->with([
                'color' => 'orange',
                'message' => 'Erro ao salvar Selo',
            ]);
        }        

        return redirect()->route('selos.edit', $selo->id)->with(['color' => 'success', 'message' => 'Selo atualizado com sucesso!']);
    }

    public function seloSetStatus(Request $request)
    {        
        $selo = Selo::find($request->id);
        $selo->status = $request->status;
        $selo->save();
        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $selo = Selo::where('id', $request->id)->first();
        $nome = \App\Helpers\Renato::getPrimeiroNome(Auth::user()->name);
        if(!empty($selo)){
            $json = "<b>$nome</b> você tem certeza que deseja excluir este Selo?";
            return response()->json(['error' => $json,'id' => $selo->id]);
        }else{
            return response()->json(['success' => true]);
        }
    }
    
    public function deleteon(Request $request)
    { 
        $selo = Selo::where('id', $request->selo_id)->first();  
        $seloR = $selo->titulo;
        if(!empty($selo)){
            !is_null($selo->imagem) && Storage::delete($selo->imagem);
            $selo->delete();
        }
        return redirect()->route('selos.index')->with(
            ['color' => 'success', 
            'message' => 'O selo '.$seloR.' foi removido com sucesso!'
        ]);
    }
}
