
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

<form action='{{ url('dashboard/'.$data->id) }}' method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{-- <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nim' id="nim">
            </div>
        </div> --}}
        <a href={{ url('dashboard') }} class="btn btn-secondary"> Kembali </a>
        <div class="mb-3 row">
            <label for="note" class="col-sm-2 col-form-label">Catatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='content' value="{{ $data->content }}" id="content">
            </div>
        </div>
        {{-- <div class="mb-3 row">
            <label for="owner" class="col-sm-2 col-form-label">Pembuat(Pegawai)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='owner' value="{{ $data->owner }}" id="owner">
            </div>
        </div> --}}
        <div class="mb-3 row">
            <label for="owner" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
@endsection
    <!-- AKHIR FORM -->