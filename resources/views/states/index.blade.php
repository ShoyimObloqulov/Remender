@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('cruds.states.title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">@lang('cruds.states.title')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('cruds.user.title_singular')</h3>
                        @can('states.create')
                            <a href="{{ route('states.create') }}" class="btn btn-success btn-sm float-right">
                                <span class="fas fa-plus-circle"></span>
                                @lang('global.add')
                            </a>
                        @endcan
                        <a href="{{ route('export.countries') }}" class="btn btn-primary btn-sm float-right mx-2"><i class="fa fa-file-excel"></i> Excel</a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Data table -->
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>@lang('cruds.user.fields.name')</th>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('global.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($states as $u)
                                <tr>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->code}}</td>
                                    <td class="text-center">
                                        <form action="{{ route('states.destroy',$u->id) }}" method="post">
                                            @csrf
                                            <div class="btn-group">
                                                <a href="{{ route('states.edit',$u->id) }}" type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if (confirm('Malumotlar o\'chishiga rozimisiz?')) { this.form.submit() } "><i class="fa fa-trash"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
