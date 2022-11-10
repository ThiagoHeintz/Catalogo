<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Adm;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogos = Catalogo::paginate(5);
        return view('catalogos.index',array('catalogos' => $catalogos,'busca'=>null));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request) {
        $catalogos = Catalogo::where('nome','LIKE','%'.$request->input('busca').'%')->orwhere('material','LIKE','%'.$request->input('busca').'%')->paginate(5);
        return view('catalogos.index',array('catalogos' => $catalogos,'busca'=>$request->input('busca')));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $adms = Adm::all();
            return view('catalogos.create',['adms'=>$adms]);
        }
        else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $this->validate($request,[
                'nome' => 'required',
                'idAdm' => 'required',
                'valor' => 'required',
                'quantidade' => 'required',
                'material' => 'required',
                'peso' => 'required',
                'tamanho' => 'required',
            ]);
            $catalogo = new Catalogo();
            $catalogo->nome = $request->input('nome');
            $catalogo->idAdm = $request->input('idAdm');
            $catalogo->valor = $request->input('valor');
            $catalogo->quantidade = $request->input('quantidade');
            $catalogo->material = $request->input('material');
            $catalogo->peso = $request->input('peso');
            $catalogo->tamanho = $request->input('tamanho');
            if($catalogo->save()) {
                if($request->hasFile('foto')){
                    $imagem = $request->file('foto');
                    $nomearquivo = md5($catalogo->id).".".$imagem->getClientOriginalExtension();
                    //dd($imagem, $nomearquivo,$contato->id);
                    $request->file('foto')->move(public_path('.\img\catalogos'),$nomearquivo);
                }
                return redirect('catalogos');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catalogo = Catalogo::find($id);
        return view('catalogos.show',array('catalogo' => $catalogo));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $catalogo = Catalogo::find($id);
            $adms = Adm::all();
            return view('catalogos.edit',['catalogo' => $catalogo,'adms'=>$adms]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $this->validate($request,[
                'nome' => 'required',
                'idAdm' => 'required',
                'valor' => 'required',
                'quantidade' => 'required',
                'material' => 'required',
                'peso' => 'required',
                'tamanho' => 'required',
            ]);
            $catalogo = Catalogo::find($id);
            if($request->hasFile('foto')){
                $imagem = $request->file('foto');
                $nomearquivo = md5($catalogo->id).".".$imagem->getClientOriginalExtension();
                $request->file('foto')->move(public_path('.\img\catalogos'),$nomearquivo);
            }
            $catalogo->nome = $request->input('nome');
            $catalogo->idAdm = $request->input('idAdm');
            $catalogo->valor = $request->input('valor');
            $catalogo->quantidade = $request->input('quantidade');
            $catalogo->material = $request->input('material');
            $catalogo->peso = $request->input('peso');
            $catalogo->tamanho = $request->input('tamanho');
            if($catalogo->save()) {
                Session::flash('mensagem','Produto alterado com sucesso');
                return redirect('catalogos');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $catalogo = Catalogo::find($id);
            if (isset($request->foto)) {
            unlink($request->foto);
            }
            $catalogo->delete();
            Session::flash('mensagem','Produto excluído com Sucesso Foto:');
            return redirect(url('catalogos/'));
        } else {
            return redirect('login');
        }
    }
}
