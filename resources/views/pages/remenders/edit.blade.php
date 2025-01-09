@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('cruds.remenders.title')}} {{__('global.edit')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('global.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('global.edit')}}</li>
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
                        <form id="quickForm" action="{{route('remenders.update',$remender->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ __('cruds.remenders.title') }}</label>
                                    <input type="text" name="name" value="{{$remender->name}}" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" placeholder="Eslatma" >
                                    @if($errors->has('name') || 1)
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>{{ __('cruds.remenders.organization') }}</label>
                                    <input type="text" value="{{$remender->desc}}" class="form-control {{ $errors->has('organization') ? "is-invalid":"" }}" placeholder="Tashkilot" name="organization">
                                    @if($errors->has('organization') || 1)
                                        <span class="error invalid-feedback">{{ $errors->first('organization') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>{{ __('global.time') }}</label>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" value="{{$remender->date}}" class="form-control {{ $errors->has('date') ? "is-invalid":"" }} datetimepicker-input" data-target="#reservationdatetime" name="date"/>

                                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
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
                                    <br>

                                    @foreach($remender->phone as $r)
                                        <div class="form-group" id="input-group-1">
                                            <input type="text" class="form-control" id="input-1" name="phone[]"  value="{{ $r }}" data-inputmask="'mask': ['+998-99-9999999']" data-mask="">
                                        </div>
                                    @endforeach
                                    <div id="input-container"></div>
                                </div>

                                <div class="form-group">
                                    <button id="add-input-email" type="button" class="btn btn-success"><i class="fas fa-plus"></i>
                                        Email - {{ __('global.add') }}
                                    </button>

                                    <br>
                                    <hr>
                                    @foreach($remender->email as $r)
                                        <div class="form-group" id="input-group-1">
                                            <input type="text" class="form-control" id="input-1" name="mail[]" value="{{ $r->email }}">
                                        </div>
                                    @endforeach
                                    <div id="input-container-2"></div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('global.submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
