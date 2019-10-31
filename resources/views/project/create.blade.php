@extends('layouts.app')
@section('title', "Project Create")

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Project</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/manage">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/manage/projects">Projects</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="/manage/projects" method="POST">
                    @csrf
                    @include('layouts.form')
                </form>
            </div>
        </div>
    </div>
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
        var now = Math.floor(Date.now() / 1000);
        $('#code').val('SBGPR'+now)

        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
        });

        $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
        });
    });
</script>
@endsection
