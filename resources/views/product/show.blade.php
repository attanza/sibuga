@extends('layouts.app')
@section('title', "Product Show")

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $data->code }} Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/manage">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/manage/products">Products</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $data->code }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <b-card no-body>
        <b-tabs pills card>
            <b-tab title="Detail" active>
                <b-card-text>
                    <div class="d-flex justify-content-end mb-4">
                        <delete-button delete-url="/api/products/{{ $data->id }}" back-url="/manage/products">
                        </delete-button>
                    </div>
                    <form method="POST" action="{{ route('products.update', ['product' => $data->id])}}">
                        @method('PUT')
                        @csrf
                        @include('layouts.form')
                    </form>
                </b-card-text>
            </b-tab>
            <b-tab title="Pictures">
                <b-card-text>
                    <picture-list pictureable-id="{{ $data->id }}" pictureable-type="Product"></picture-list>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</div>
@endsection
