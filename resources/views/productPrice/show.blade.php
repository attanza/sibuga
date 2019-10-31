@extends('layouts.app')
@section('title', "ProductPrice Show")

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $data->product ? $data->product->name : $data->id }} Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/manage">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/manage/product-prices">ProductPrices</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $data->product ? $data->product->name : $data->id }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <delete-button delete-url="/api/product-prices/{{ $data->id }}" back-url="/manage/product-prices">
                </delete-button>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('product-prices.update', ['product_price' => $data->id])}}">
                    @method('PUT')
                    @csrf
                    @include('layouts.form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
