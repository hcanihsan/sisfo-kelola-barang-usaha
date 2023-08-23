
@extends('layout.themedashboard')
<!-- START FORM -->
@section('content')

@if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                <li>
                    {{ $item}}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form action='{{ url('manageproduct') }}' method='post' enctype="multipart/form-data">
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{-- <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nim' id="nim">
            </div>
        </div> --}}
        <a href={{ url('manageproduct') }} class="btn btn-dark"> Kembali </a>
        <div class="mb-3 row">
            <label for="nameproduct" class="col-sm-2 col-form-label">Nama Produk : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nameproduct' value="{{ Session::get('nameproduct')}}" id="nameproduct">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="category" class="col-sm-2 col-form-label">Kategori Produk : </label>
            <div class="col-sm-10">
               <select name="category" id="category" class="form-control">
                <option value="none" selected disabled hidden>--Pilih Kategori Produk--</option>
                <option value="Makanan" >Makanan</option>
                <option value="Minuman" >Minuman</option>
                <option value="Peralatan Sekolah" >Peralatan Sekolah</option>
                <option value="Alat Tulis" >Alat Tulis</option>
                <option value="Pembersih" >Pembersih</option>
                <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                <option value="Lainnya">Lainnya</option>
               </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="quantity" class="col-sm-2 col-form-label">Total Jumlah Produk : </label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='quantity' value="{{ Session::get('quantity')}}" id="quantity">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="priceperunit" class="col-sm-2 col-form-label">Harga Per Buah/Unit : </label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='priceperunit' value="{{ Session::get('priceperunit')}}" id="priceperunit">
            </div>
        </div>

        
        <div class="mb-3 row">
            <label for="imgproduct" class="col-sm-2 col-form-label">Gambar Produk</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name='imgproduct' id="imgproduct">
            </div>
        </div>

        {{-- <div class="mb-3 row">
            <label for="owner" class="col-sm-2 col-form-label">Pembuat(Pegawai) : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='owner' value="{{ Session::get('owner')}}" id="owner">
            </div>
        </div> --}}
        <div class="mb-3 row">
            <label for="owner" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10 text-center"><button type="submit" class="btn btn-primary" name="submit">Simpan Produk Baru</button></div>
        </div>
    </div>
</form>
@endsection
    <!-- AKHIR FORM -->