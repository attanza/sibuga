@extends('layouts.app')
@section('title', "QuotationProduct Show")

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $data->name }} Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/manage">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/manage/quotationproducts">QuotationProducts</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $data->name }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <delete-button delete-url="/api/quotation-products/{{ $data->id }}"
                    back-url="/manage/quotation-products">
                </delete-button>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ route('quotation-products.update', ['quotation_product' => $data->id])}}">
                    @method('PUT')
                    @csrf
                    @include('layouts.form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
