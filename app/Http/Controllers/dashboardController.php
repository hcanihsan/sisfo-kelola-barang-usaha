<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dashboard;
use App\Models\product;
use App\Models\historySell;
use Illuminate\Support\Facades\Auth;
use Session;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kywords = $request->katakunci;
        $totalNumbers = 5;
        $dataTotalProduct = product::get('quantity');
        $dataTotalProfit = historySell::get('totalprice');
        $dataTotalSell = historySell::get('quantity');

        if(Auth::User()->id != '2'){
            if(strlen($kywords)){
                $data= dashboard::where('content','like',"%$kywords%")
                ->Where('id_user',Auth::User()->id)
                ->orWhere('owner','like',"%$kywords%")
                ->paginate($totalNumbers);
            } else{
                $data = dashboard::orderBy('id','desc')->
                where('id_user',Auth::User()->id)->
                paginate($totalNumbers);
            }
        }else{
            if(strlen($kywords)){
                $data= dashboard::where('content','like',"%$kywords%")
                ->Where('owner','like',"%$kywords%")
                ->paginate($totalNumbers);
            } else{
                $data = dashboard::orderBy('id','desc')->
                paginate($totalNumbers);
            }

        }
        
        return view('home.dashboard')->with('data',$data)->with('dataTotalProduct',$dataTotalProduct)->with('dataTotalProfit',$dataTotalProfit)->with('dataTotalSell',$dataTotalSell);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.addnote');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->flash('content', $request->content);
        //$request->session()->flash('owner', $request->owner);
        // Session::flash('content', $request->content);
        // Session::flash('owner', $request->owner);
        $request->validate([
            'content'=>'required'],[
                'content.required'=>'Catatan Wajib Diisi'
            ]);
        $data = [
            'content'=>$request->content,
            'owner'=>Auth::User()->name,
            'id_user'=>Auth::User()->id
        ];

        dashboard::create($data);
        return redirect()->to('dashboard')->with('Berhasil','Data Berhasil Ditambahkan');
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
        $data = dashboard::where('id',$id)->first();
        return view('home.editnote')->with('data',$data);
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
        $request->validate([
            'content'=>'required'],
            [
                'content.required'=>'Catatan Wajib Diisi'
            ]);
        $data = [
            'content'=>$request->content,
            'owner'=>Auth::User()->name,
        ];

        dashboard::where('id',$id)->update($data);
        return redirect()->to('dashboard')->with('Berhasil','Data Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       dashboard::where('id',$id)->delete();

       return redirect()->to('dashboard')->with('Berhasil', 'Data Berhasil Dihapus');
    }
}
