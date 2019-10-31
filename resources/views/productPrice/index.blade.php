@extends('layouts.app')
@section('title', 'ProductPrices')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">ProductPrices</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/manage">Dashboard</a></li>
                    <li class="breadcrumb-item active">ProductPrices</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <product-price-list></product-price-list>
        </div>
    </div>
</div>


@endsection
