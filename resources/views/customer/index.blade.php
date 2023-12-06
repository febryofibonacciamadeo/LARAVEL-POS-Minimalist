@extends('layouts.app', ['page' => __('Customer'), 'pageSlug' => 'customer'])
                        
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
                            <h4 class="card-title">Customers</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/Customer/Add" class="btn btn-sm btn-primary">Add Customer</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Kontak</th>
                                    <th scope="col">No Member</th>
                                    <th scope="col">Berlaku Hingga</th>
                                    <th scope="col">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $data)
                                <tr>
                                    <td>{{ $data->customer_name }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>{{ $data->contact }}</td>
                                    <td>{{ $data->membership_number }}</td>
                                    <td>{{ $data->expected_date }}</td>
                                    <td>{{ $data->note }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="/Customer/Edit/{{ $data->customer_id }}">Edit</a>
                                                <form method="post" action="/Customer/Delete/{{ $data->customer_id }}">
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
