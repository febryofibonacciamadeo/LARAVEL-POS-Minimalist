@extends('layouts.app', ['page' => __('Struk'), 'pageSlug' => 'Struk'])
                        
@section('content')
<div class="content" onload="window.print();">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Sales</h4>
                        </div>
                        <div class="col-4 text-right">
                            Invoice: {{ session('invoice') }}
                        </div>
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
                                            {{ $amount }}
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
                                <tr>
                                    <td>Change: </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $change }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection