@extends('backend.default')

@section('content')
<div class="box-body">
    <table class="table table-bordered table-hover" id="dataTable">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Per-Unit</th>
                <th>Total Persediaan</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through the products to display the data --}}
            @foreach($productsByCategory as $category => $categoryData)
                @foreach($categoryData['products'] as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->harga_unit }}</td>
                    <td>{{ $product->total_persediaan }}</td>
                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</td> 
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection()
