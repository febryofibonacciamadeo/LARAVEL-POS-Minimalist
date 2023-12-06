@extends('layouts.app', ['page' => __('Sales'), 'pageSlug' => 'sales'])
                        
@section('content')
<div class="content">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/Sales/Save/{{ session('invoice') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('customer') ? ' has-danger' : '' }}">
                            <label>{{ __('Customer') }}</label>
                            <input autocomplete="off" type="text" name="customer" class="text-dark form-control{{ $errors->has('customer') ? ' is-invalid' : '' }}" placeholder="{{ __('Customer') }}">
                            @include('alerts.feedback', ['field' => 'customer'])
                        </div>
                        <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
                        <input type="hidden" name="profit" value="{{ $ttl_profit }}">
                        <div class="form-group{{ $errors->has('customer') ? ' has-danger' : '' }}">
                            <label>{{ __('Bayar') }}</label>
                            <input autocomplete="off" type="text" placeholder="{{ $ttl_amount }}" name="amount" class="text-dark form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Bayar') }}">
                            @include('alerts.feedback', ['field' => 'amount'])
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-success">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                            <h4 class="card-title">Sales</h4>
                        </div>
                        <div class="col-4 text-right">
                            Invoice: {{ session('invoice') }}
                        </div>
                    </div>
                    <form action="/Sales/Incoming" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <select required name="product_id" class="form-control" placeholder="Pilih produk...">
                                        <option></option>
                                        @foreach($product as $prod)
                                        <option class="text-dark" value="{{ $prod->product_id }}">{{ $prod->product_code }} - {{ $prod->product_name }} - {{ $prod->gen_name }} | Expires at: {{ $prod->expiry_date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input required autocomplete="off" type="number" name="qty" class="form-control" placeholder="{{ __('Qty') }}">
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Profit</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $data)
                                <tr>
                                    <td>{{ $data->product_code }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->product_category }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{{ $data->profit }}</td>
                                    <td>
                                        <form method="post" action="/Sales/Cancel/{{ $data->transaction_id }}/{{ $data->product_code }}/{{ $data->qty }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" style="cursor: pointer !important;" type="submit">
                                                <i class="tim-icons icon-trash-simple"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Amount: </td>
                                    <td>Total Profit: </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total: </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        @if($amount !== null)
                                            @foreach($amount as $amount)
                                                {{ $amount->total_amount }}
                                            @endforeach
                                        @else
                                            0
                                            @endif
                                    </td>
                                    <td>
                                        @if($profit !== null)
                                            @foreach($profit as $profit)
                                                {{ $profit->total_profit }}
                                            @endforeach
                                        @else   
                                            0
                                        @endif
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#exampleModal">Bayar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection