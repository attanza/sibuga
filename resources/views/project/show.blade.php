@extends('layouts.app')
@section('title', "Project Show")

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
                    <li class="breadcrumb-item"><a href="/manage/projects">Projects</a>
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
                        {{-- <a href="/manage/projects/{{ $data->id }}/pdf" class="btn btn-success">Generate PDF</a>
                        --}}
                        <delete-button delete-url="/api/projects/{{ $data->id }}" back-url="/manage/projects">
                        </delete-button>
                    </div>
                    <form method="POST" action="{{ route('projects.update', ['project' => $data->id])}}">
                        @method('PUT')
                        @csrf
                        @include('layouts.form')
                    </form>
                </b-card-text>
            </b-tab>
            <b-tab title="Products">
                <b-card-text>
                    <project-products :products="{{ $data->quotation->products }}">
                        </projects-products>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
</div>
@endsection


@section('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
</script>

<script>
    $(document).ready(function(){

        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
        });

        $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
        });
    });
</script>
@endsection
