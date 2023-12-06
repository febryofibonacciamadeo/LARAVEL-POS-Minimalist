@extends('layouts.app', ['page' => __('Add Supplier'), 'pageSlug' => 'supplier'])

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Add Supplier') }}</h5>
            </div>
            <form method="post" action="/Supplier/Add" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @include('alerts.success')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('suplier_name') ? ' has-danger' : '' }}">
                                <label>{{ __('Nama Supplier') }}</label>
                                <input autocomplete="off" type="text" name="suplier_name" class="form-control{{ $errors->has('suplier_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Supplier') }}">
                                @include('alerts.feedback', ['field' => 'suplier_name'])
                            </div>

                            <div class="form-group{{ $errors->has('suplier_address') ? ' has-danger' : '' }}">
                                <label>{{ __('Alamat') }}</label>
                                <input autocomplete="off" type="text" name="suplier_address" class="form-control{{ $errors->has('suplier_address') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}">
                                @include('alerts.feedback', ['field' => 'suplier_address'])
                            </div>
                            <div class="form-group{{ $errors->has('suplier_contact') ? ' has-danger' : '' }}">
                                <label>{{ __('Kontak Personal') }}</label>
                                <input autocomplete="off" type="text" name="suplier_contact" class="form-control{{ $errors->has('suplier_contact') ? ' is-invalid' : '' }}" placeholder="{{ __('Kontak Personal') }}">
                                @include('alerts.feedback', ['field' => 'suplier_contact'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('contact_person') ? ' has-danger' : '' }}">
                                <label>{{ __('Nomor Kontak') }}</label>
                                <input autocomplete="off" type="tel" name="contact_person" class="form-control{{ $errors->has('contact_person') ? ' is-invalid' : '' }}" placeholder="{{ __('Nomor Kontak') }}">
                                @include('alerts.feedback', ['field' => 'contact_person'])
                            </div>
                            <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
                                <label>{{ __('Catatan') }}</label>
                                <input autocomplete="off" name="note" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" placeholder="{{ __('Catatan') }}">
                                @include('alerts.feedback', ['field' => 'note'])
                            </div>
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
