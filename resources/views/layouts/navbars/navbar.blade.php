@php 
    $Auth = session('DataLogin');
@endphp
@if($Auth)
    @include('layouts.navbars.navs.auth')
@else
    @include('layouts.navbars.navs.guest')
@endif
