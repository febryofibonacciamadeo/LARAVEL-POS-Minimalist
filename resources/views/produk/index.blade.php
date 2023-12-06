@extends('layouts.app', ['page' => __('Product'), 'pageSlug' => 'product'])
                        
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    @if(session('success'))
                    <div class="alert alert-success fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Products</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/Produk/Add" class="btn btn-sm btn-primary">Add Product</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Nama Brand</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Kedatangan</th>
                                    <th scope="col">Expire</th>
                                    <th scope="col">Harga Beli</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Terjual</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $data)
                                <tr>
                                    <td>{{ $data->product_code }}</td>
                                    <td>{{ $data->product_category }}</td>
                                    <td>{{ $data->product_name }}</td>
                                    <td>{{ $data->gen_name }}</td>
                                    <td>{{ $data->supplier }}</td>
                                    <td>{{ $data->date_arrival }}</td>
                                    <td>{{ $data->expiry_date }}</td>
                                    <td>{{ $data->o_price }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->qty_sold }}</td>
                                    <td>{{ $data->total }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="/Produk/Edit/{{ $data->product_id }}">Edit</a>
                                                <form method="post" action="/Produk/Delete/{{ $data->product_id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item" style="cursor: pointer !important;" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection