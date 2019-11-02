@extends('layouts.app')
@section('title', "Expense Show")

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
                    <li class="breadcrumb-item"><a href="/manage/expenses">Expenses</a>
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
                        <delete-button delete-url="/api/expenses/{{ $data->id }}" back-url="/manage/expenses">
                        </delete-button>
                    </div>
                    <form method="POST" action="{{ route('expenses.update', ['expense' => $data->id])}}">
                        @method('PUT')
                        @csrf
                        @include('layouts.form')
                    </form>
                </b-card-text>
            </b-tab>
            <b-tab title="Attachments">
                <b-card-text>
                    <picture-list pictureable-id="{{ $data->id }}" pictureable-type="Expense"></picture-list>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</div>
@endsection
