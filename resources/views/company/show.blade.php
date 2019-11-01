@extends('layouts.app')
@section('title', "Company Show")

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
                    <li class="breadcrumb-item"><a href="/manage/companies">Companies</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $data->name }}</li>
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
                        <delete-button delete-url="/api/companies/{{ $data->id }}" back-url="/manage/companies">
                        </delete-button>
                    </div>
                    <form method="POST" action="{{ route('companies.update', ['company' => $data->id])}}">
                        @method('PUT')
                        @csrf
                        @include('layouts.form')
                    </form>
                </b-card-text>
            </b-tab>
            <b-tab title="Contacts">
                <b-card-text>
                    <company-contacts company-id="{{ $data->id }}">
                    </company-contacts>
                </b-card-text>
            </b-tab>
            @if ($data->category === 'Vendor')
            <b-tab title="Products">
                <b-card-text>
                    <company-products company-id="{{ $data->id }}">
                    </company-products>
                </b-card-text>
            </b-tab>
            @endif
        </b-tabs>
    </b-card>
</div>
@endsection
