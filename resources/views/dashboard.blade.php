@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category"></h5>
                            <h2 class="card-title">Penjualan</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="grafikPenjualan" class="chartjs-render-monitor" style="width:70%; height: 60%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category"></h5>
                            <h2 class="card-title">Supplier</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kontak Supplier</th>
                                <th scope="col">Kontak Personal</th>
                                <th scope="col">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplier as $supplier)
                            <tr>
                                <td>{{ $supplier->suplier_name }}</td>
                                <td>{{ $supplier->suplier_address }}</td>
                                <td>{{ $supplier->suplier_contact }}</td>
                                <td>{{ $supplier->contact_person }}</td>
                                <td>{{ $supplier->note }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category"></h5>
                            <h2 class="card-title">Produk</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $product)
                            <tr>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->product_category }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->gen_name }}</td>
                                <td>{{ $product->supplier }}</td>
                                <td>{{ $product->date_arrival }}</td>
                                <td>{{ $product->expiry_date }}</td>
                                <td>{{ $product->o_price }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->qty }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush

@section('script_js')
<script>
    gradientChartOptionsConfiguration =  {
    maintainAspectRatio: false,
    legend: {
        display: false
    },

    tooltips: {
        backgroundColor: '#fff',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
    },
    responsive: true,
    scales:{
        yAxes: [{
        barPercentage: 1.6,
            gridLines: {
                drawBorder: false,
                color: 'rgba(29,140,248,0.0)',
                zeroLineColor: "transparent",
            },
            ticks: {
                suggestedMin:50,
                suggestedMax: 110,
                padding: 20,
                fontColor: "#9a9a9a"
            }
            }],

        xAxes: [{
        barPercentage: 1.6,
            gridLines: {
                drawBorder: false,
                color: 'rgba(220,53,69,0.1)',
                zeroLineColor: "transparent",
            },
            ticks: {
                padding: 20,
                fontColor: "#9a9a9a"
            }
            }]
        }
    };

    var ctx = document.getElementById("grafikPenjualan").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0,230,0,50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)');

    fetch('/data-penjualan').then(response => response.json())
    .then(res => {
        var myChart = new Chart(ctx, {
        type: 'line',
        data:{ 
                labels: res.map(item => item.name),
                datasets: [{
                    label: "Data",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#d048b6',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#d048b6',
                    pointBorderColor:'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#d048b6',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: res.map(item => item.qty),
                }],
                options: gradientChartOptionsConfiguration
            }
        }); 
    });
</script>
@endsection
