<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\product;
use Session;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kywords = $request->keywords;
        $limitDataPaginate = 5;
        if(strlen($kywords)){
            $data = product::where('nameproduct','like',"%$kywords%")
            ->orWhere('category','like',"%$kywords%")
            ->paginate($limitDataPaginate);
        }else{
            $data = product::orderBy('id','desc')->paginate($limitDataPaginate);
        }
        return view('home.manageproduct')->with('data',$data);
    }

    // public function totalProduct(Request $request)
    // {
    //     $data = product::sum('quantity');

    //     return $data;
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.addproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->flash('nameproduct', $request->nameproduct);
        $request->session()->flash('category', $request->category);
        $request->session()->flash('quantity', $request->quantity);
        $request->session()->flash('priceperunit', $request->priceperunit);

        $request->validate([
            'nameproduct'=>'required',
            'category'=>'required',
            'quantity'=>'required|integer',
            'priceperunit'=>'required|integer',
            'imgproduct'=>'required|mimes:jpeg,jpg,png'
        ],
        [
            'nameproduct.required'=>'Nama Produk Wajib Diisi',
            'category.required'=>'Kategori Wajib Diisi',
            'quantity.required'=>'Jumlah Produk Wajib Diisi',
            'quantity.integer'=>'Tuliskan Jumlah Produk dalam Angka Saja',
            'priceperunit.required'=>'Harga Per Produk Wajib Diisi',
            'priceperunit.integer'=>'Tuliskan Harga dalam Angka Saja',
            'imgproduct.required'=>'Gambar Produk Wajib Dimasukkan',
            'imgproduct.mimes'=>'Gambar Hanya Boleh Format JPEG,JPG,PNG'
        ]);

        $img_file = $request->file('imgproduct');
        $img_format = $img_file->extension();
        $img_name = date('ymdhis').".".$img_format;
        $img_file->move(public_path('imgproduct'), $img_name);

        $data = [
            'nameproduct'=>$request->nameproduct,
            'category'=>$request->category,
            'quantity'=>$request->quantity,
            'priceperunit'=>$request->priceperunit,
            'imgproduct'=> $img_name
        ];

        product::create($data);
        return redirect()->to('manageproduct')->with('success','Produk Berhasil Ditambahkan');
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
        $data = product::where('id',$id)->first();
        return view('home.editproduct')->with('data',$data);
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
            'nameproduct'=>'required',
            'category'=>'required',
            'quantity'=>'required|integer',
            'priceperunit'=>'required|integer',
        ],
        [
            'nameproduct.required'=>'Nama Produk Wajib Diisi',
            'category.required'=>'Kategori Wajib Diisi',
            'quantity.required'=>'Jumlah Produk Wajib Diisi',
            'quantity.integer'=>'Tuliskan Jumlah Produk dalam Angka Saja',
            'priceperunit.required'=>'Harga Per Produk Wajib Diisi',
            'priceperunit.integer'=>'Tuliskan Harga dalam Angka Saja'
        ]);

        $data = [
            'nameproduct'=>$request->nameproduct,
            'category'=>$request->category,
            'quantity'=>$request->quantity,
            'priceperunit'=>$request->priceperunit,
        ];

        if($request->hasFile('imgproduct')){
            $request->validate([
                'imgproduct'=>'mimes:jpeg,jpg,png'
            ],
            [
                'imgproduct.mimes'=>'Gambar Hanya Boleh Format JPEG,JPG,PNG'
            ]);

            $img_file = $request->file('imgproduct');
            $img_format = $img_file->extension();
            $img_name = date('ymdhis').".".$img_format;
            $img_file->move(public_path('imgproduct'), $img_name);

            $data_imgproduct = product::where('id',$id)->first();
            File::delete(public_path('imgproduct').'/'.$data_imgproduct->imgproduct);

            $data['imgproduct'] = $img_name;
        }
        product::where('id',$id)->update($data);
        return redirect()->to('manageproduct')->with('success','Produk Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = product::where('id',$id)->first();
        File::delete(public_path('imgproduct').'/'.$data->imgproduct);
        product::where('id',$id)->delete();
        return redirect()->to('manageproduct')->with('success','Produk Berhasil Dihapus');
    }
}
