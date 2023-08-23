
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

<form action='{{ url('manageproduct/'.$data->id) }}' method='post' enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        
        <a href={{ url('manageproduct') }} class="btn btn-secondary"> Kembali </a>

        <div class="mb-3 row">
            <label for="nameproduct" class="col-sm-2 col-form-label">Nama Produk : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nameproduct' value="{{ $data->nameproduct }}" id="nameproduct">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="category" class="col-sm-2 col-form-label">Kategori Produk : </label>
            <div class="col-sm-10">
               <select name="category" id="category" class="form-control">
                <option value="{{ $data->category }}" selected>{{ $data->category }}</option>
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
                <input type="number" class="form-control" name='quantity' value="{{ $data->quantity }}" id="quantity">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="priceperunit" class="col-sm-2 col-form-label">Harga Per Buah/Unit : </label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='priceperunit' value="{{ $data->priceperunit }}" id="priceperunit">
            </div>
        </div>

        @if ($data->imgproduct)
            <div class="mb-3">
                <img style="max-height: 100px; max-width: 100px;" src="{{ url('imgproduct').'/'.$data->imgproduct }}"/>
            </div>
            
        @endif
        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Gambar Produk : </label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name='imgproduct' id="imgproduct">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="owner" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button></div>
        </div>
    </div>
</form>
@endsection
    <!-- AKHIR FORM -->