
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/mainstyle.css">
    <title>Kelola Produk</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!--Sidebar-->
        <div class="bg-dark" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"> <h5 class="text-light">Sisfo KBU</h5></div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ url('dashboard')}}" class="list-group-item list-group-item-action bg-dark second-text fw-bold"><i class="ri-dashboard-2-line text-light"></i><h6 class="text-light">Dashboard Utama</h6></a>
                {{-- <a href="#" class="list-group-item list-group-item-action bg-dark second-text fw-bold"><i class="ri-bank-card-line text-light"></i><h6 class="text-light">Menu Kasir</h6></a> --}}
                <a href="#" class="list-group-item list-group-item-action bg-trasparent second-text active"><i class="ri-draft-line text-light"></i><h6 class="text-light">Kelola Barang</h6></a>
                <a href="{{ url('historysell')}}" class="list-group-item list-group-item-action bg-dark second-text fw-bold"><i class="ri-file-history-line text-light"></i><h6 class="text-light">Riwayat Penjualan</h6></a>
                <a href="{{ route('actionlogout')}}" class="list-group-item list-group-item-action bg-dark second-text fw-bold"><i class="ri-logout-box-r-line text-light"></i><h6 class="text-light">Logout</h6></a>
            </div>
        </div>
        <!--
            Sidebar End
        -->
<div class="page-content-wrapper">

    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="d-flex align-items-center">
                <i class="ri-draft-fill ri-2x" id="menu-toggle">
                </i><h2 class="fs-2 m-0">Kelola Barang</h2>
            </div>            
        
        <div class="row my-5">
            <h3 class="fs-4 mb-3">Daftar Produk</h3>
           <div class="fs-4 mb-3" >
            <a href='{{ url('manageproduct/create')}}' class="btn btn-primary">+ Tambah Produk</a>
        
           </div>
        
           <form class="d-flex fs-4 mb-3" action="{{ url('manageproduct') }}" method="get">
            <input class="form-control me-1" type="search" name="keywords" value="{{ Request::get('keywords') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-dark" type="submit">Cari</button>
        </form>
        
            <div class="col">
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">No</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Per Produk</th>
                            <th scope="col">Gambar Produk</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @foreach ($data as $item)

                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $item->nameproduct}}</td>
                            <td>{{ $item->category}}</td>
                            <td>{{ $item->quantity}} Buah/Unit</td>
                            <td>{{ $item->rupiahFormat('priceperunit') }}/Buah</td>
                            <td>
                                @if ($item->imgproduct)
                                    <img style="max-height: 100px; max-width:100px; width:100px; height:100px;" src="{{ url('imgproduct').'/'.$item->imgproduct}}"/>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href='{{ url('manageproduct/'.$item->id.'/edit') }}' class="btn btn-success">Edit</a>
                                <form onsubmit="return confirm('Ingin Menghapus Data Ini ?')" class="d-inline" action="{{ url('manageproduct/'.$item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>    
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                        
                    </tbody>
                </table>
                {{ $data->withQueryString()->links()}}
            </div>
        </div>
    </div>
 </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>