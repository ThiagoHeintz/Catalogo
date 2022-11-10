<?php

namespace App\Http\Controllers;

use App\Models\adm;
use App\Models\Catalogo;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adms = Adm::paginate(5);
        return view('adms.index',array('adms' => $adms,'busca'=>null));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request) {
        $adms = Adm::where('nome','LIKE','%'.$request->input('busca').'%')->orwhere('email','LIKE','%'.$request->input('busca').'%')->paginate(5);
        return view('adms.index',array('adms' => $adms,'busca'=>$request->input('busca')));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            return view('adms.create');
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
                'telefone' => 'required',
                'email' => 'required',
            ]);
            $adm = new Adm();
            $adm->nome = $request->input('nome');
            $adm->telefone = $request->input('telefone');
            $adm->email = $request->input('email');
            if($adm->save()) {
                if($request->hasFile('foto')){
                    $imagem = $request->file('foto');
                    $nomearquivo = md5($adm->id).".".$imagem->getClientOriginalExtension();
                    $request->file('foto')->move(public_path('.\img\adms'),$nomearquivo);
                }
                return redirect('adms');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\adm  $adm
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adm = Adm::find($id);
        return view('adms.show',array('adm' => $adm));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adm  $adm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $adm = Adm::find($id);
            return view('adms.edit',['adm' => $adm]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adm  $adm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $this->validate($request,[
                'nome' => 'required',
                'telefone' => 'required',
                'email' => 'required',
            ]);
            $adm = Adm::find($id);
            if($request->hasFile('foto')){
                $imagem = $request->file('foto');
                $nomearquivo = md5($adm->id).".".$imagem->getClientOriginalExtension();
                $request->file('foto')->move(public_path('.\img\adms'),$nomearquivo);
            }
            $adm->nome = $request->input('nome');
            $adm->telefone = $request->input('telefone');
            $adm->email = $request->input('email');;
            if($adm->save()) {
                Session::flash('mensagem','Adm alterado com sucesso');
                return redirect('adms');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adm  $adm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if ((Auth::check()) && (Auth::user()->isAdmin())) {
            $adm = Adm::find($id);
            if (isset($request->foto)) {
            unlink($request->foto);
            }
            $adm->delete();
            Session::flash('mensagem','Adm excluído com Sucesso Foto:');
            return redirect(url('adms/'));
        } else {
            return redirect('login');
        }
    }
}
