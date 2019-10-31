@extends('layouts.app')
@section('title', "Quotation Show")

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quotation#{{ $data->no }} Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/manage">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/manage/quotations">Quotations</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $data->no }}</li>
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
                    <div class="d-flex justify-content-between mb-4">
                        <a href="/manage/quotations/{{ $data->id }}/pdf" class="btn btn-success">Generate PDF</a>
                        <delete-button delete-url="/api/quotations/{{ $data->id }}" back-url="/manage/quotations">
                        </delete-button>
                    </div>
                    <form method="POST" action="{{ route('quotations.update', ['quotation' => $data->id])}}">
                        @method('PUT')
                        @csrf
                        @include('layouts.form')
                    </form>
                </b-card-text>
            </b-tab>
            <b-tab title="Products">
                <b-card-text>
                    <quotation-products quotation-id="{{ $data->id }}" :products="{{ $products }}">
                    </quotation-products>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</div>
@endsection
