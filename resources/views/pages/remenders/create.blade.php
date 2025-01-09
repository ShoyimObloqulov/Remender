@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('cruds.remenders.title')}} {{__('cruds.remenders.create')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('global.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('cruds.remenders.create')}}</li>
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

                        <form id="quickForm" action="{{route('remenders.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{__('global.name')}}</label>
                                    <input type="text" name="name" value="{{old('name')}}"
                                           class="form-control {{ $errors->has('name') ? "is-invalid":"" }}"
                                           placeholder="Напоминание">
                                    @if($errors->has('name') || 1)
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>{{ __('cruds.remenders.organization') }}</label>
                                    <input type="text" value="{{old('organization')}}"
                                           class="form-control {{ $errors->has('organization') ? "is-invalid":"" }}"
                                           placeholder="Организация" name="organization">
                                    @if($errors->has('organization') || 1)
                                        <span class="error invalid-feedback">{{ $errors->first('organization') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{ __('cruds.remenders.starttime') }}</label>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" value="{{old('date')}}"
                                               class="form-control {{ $errors->has('date') ? "is-invalid":"" }} datetimepicker-input"
                                               data-target="#reservationdatetime" name="date"/>

                                        <div class="input-group-append" data-target="#reservationdatetime"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @if($errors->has('date') || 1)
                                            <span class="error invalid-feedback">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button id="add-input-phone" type="button" class="btn btn-success"><i class="fas fa-plus"></i>
                                       {{ __('global.phone') }} - {{ __('global.add') }}
                                    </button>
                                    <div id="input-container"></div>
                                </div>

                                <div class="form-group">
                                    <button id="add-input-email" type="button" class="btn btn-success"><i class="fas fa-plus"></i>
                                        Email - {{ __('global.add') }}
                                    </button>
                                    <div id="input-container-2"></div>
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
