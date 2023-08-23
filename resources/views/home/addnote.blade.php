
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

<form action='{{ url('dashboard') }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{-- <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nim' id="nim">
            </div>
        </div> --}}
        <a href={{ url('dashboard') }} class="btn btn-dark"> Kembali </a>
        <div class="mb-3 row">
            <label for="note" class="col-sm-2 col-form-label">Catatan : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='content' value="{{ Session::get('content')}}" id="content">
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
            <div class="col-sm-10 text-center"><button type="submit" class="btn btn-primary" name="submit">Simpan Data Baru</button></div>
        </div>
    </div>
</form>
@endsection
    <!-- AKHIR FORM -->