@extends('layouts.app', ['page' => __('Add Product'), 'pageSlug' => 'product'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Add Product') }}</h5>
            </div>
            <form method="post" action="/Produk/Add" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @include('alerts.success')
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <div class="form-group{{ $errors->has('product_code') ? ' has-danger' : '' }}">
                                <label>{{ __('Barcode') }}</label>
                                <input autocomplete="off" type="text" name="product_code" class="form-control{{ $errors->has('product_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Barcode') }}">
                                @include('alerts.feedback', ['field' => 'product_code'])
                            </div> -->
                            <div class="form-group{{ $errors->has('product_category') ? ' has-danger' : '' }}">
                                <label>{{ __('Kategori') }}</label>
                                <input autocomplete="off" type="text" name="product_category" class="form-control{{ $errors->has('product_category') ? ' is-invalid' : '' }}" placeholder="{{ __('Kategori') }}">
                                @include('alerts.feedback', ['field' => 'product_category'])
                            </div>
                            <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                                <label>{{ __('Nama Produk') }}</label>
                                <input autocomplete="off" type="text" name="product_name" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Produk') }}">
                                @include('alerts.feedback', ['field' => 'product_name'])
                            </div>
                            <div class="form-group{{ $errors->has('gen_name') ? ' has-danger' : '' }}">
                                <label>{{ __('Nama Brand') }}</label>
                                <input autocomplete="off" type="text" name="gen_name" class="form-control{{ $errors->has('gen_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Brand') }}">
                                @include('alerts.feedback', ['field' => 'gen_name'])
                            </div>
                            <div class="form-group{{ $errors->has('supplier') ? ' has-danger' : '' }}">
                                <label for="supplier">{{ __('Supplier') }}</label>
                                <select class="form-control" id="supplier" name="supplier">
                                    <option selected disabled>Pilih supplier...</option>
                                    @foreach($supplier as $supp)
                                    <option value="{{ $supp->suplier_name }}" class="text-dark">{{ $supp->suplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('date_arrival') ? ' has-danger' : '' }}">
                                <label>{{ __('Tanggal Kedatangan') }}</label>
                                <input autocomplete="off" type="date" name="date_arrival" class="form-control{{ $errors->has('date_arrival') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal Kedatangan') }}">
                                @include('alerts.feedback', ['field' => 'date_arrival'])
                            </div>
                            <div class="form-group{{ $errors->has('expiry_date') ? ' has-danger' : '' }}">
                                <label>{{ __('Tanggal Expired') }}</label>
                                <input autocomplete="off" type="date" name="expiry_date" class="form-control{{ $errors->has('expiry_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal Expired') }}">
                                @include('alerts.feedback', ['field' => 'expiry_date'])
                            </div>
                            <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                <label>{{ __('Harga Jual') }}</label>
                                <input onkeyup="sum()" autocomplete="off" id="price" type="text" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga Jual') }}">
                                @include('alerts.feedback', ['field' => 'price'])
                            </div>
                            <div class="form-group{{ $errors->has('o_price') ? ' has-danger' : '' }}">
                                <label>{{ __('Harga Beli') }}</label>
                                <input onkeyup="sum()" autocomplete="off" id="o_price" type="text" name="o_price" class="form-control{{ $errors->has('o_price') ? ' is-invalid' : '' }}" placeholder="{{ __('Harga Beli') }}">
                                @include('alerts.feedback', ['field' => 'o_price'])
                            </div>
                            <div class="form-group{{ $errors->has('profit') ? ' has-danger' : '' }}">
                                <label>{{ __('Profit') }}</label>
                                <input readonly autocomplete="off" id="profit" type="number" name="profit" class="form-control{{ $errors->has('profit') ? ' is-invalid' : '' }} text-light" placeholder="{{ __('Profit') }}">
                                @include('alerts.feedback', ['field' => 'profit'])
                            </div>
                            <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                <label>{{ __('Kuantitas') }}</label>
                                <input onkeyup="sum()" autocomplete="off" id="qty" type="number" name="qty" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ __('Kuantitas') }}">
                                @include('alerts.feedback', ['field' => 'price'])
                            </div>
                            <input type="hidden" id="qty_sold" name="qty_sold">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script_js')
<script>
    function sum() {
        var txtSellingPrice = document.getElementById("price").value;
        var txtOriginalPrice = document.getElementById("o_price").value;
        var result = parseInt(txtSellingPrice) - parseInt(txtOriginalPrice);
        if(!isNaN(result)) {
            document.getElementById("profit").value = result;
        }
        var txtQuantity = document.getElementById("qty").value;
        var result = parseInt(txtQuantity);
        if(!isNaN(result)) {
            document.getElementById("qty_sold").value = result;
        }
    }
</script>
@endsection
