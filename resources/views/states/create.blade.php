@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('cruds.states.title')}} {{__('cruds.states.create')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('global.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('cruds.states.create')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">

                    <div class="card card-primary">

                        <form id="quickForm" action="{{route('states.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ __('global.name') }}</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" placeholder="Имя" >
                                    @if($errors->has('name') || 1)
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('global.submit')</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-6">
                </div>

            </div>

        </div>
    </section>
@endsection
