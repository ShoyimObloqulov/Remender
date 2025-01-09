@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('cruds.guests.title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('global.home')</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @can('guests.create')
                                <a href="{{ route('guests.create') }}" class="btn btn-success btn-sm float-right">
                                    <span class="fas fa-plus-circle"></span>
                                    @lang('global.add')
                                </a>
                            @endcan

                        </div>

                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('global.d_name') }}</th>
                                    <th>{{__('global.state')}}</th>
                                    <th>{{ __('global.a_number') }}</th>
                                    <th>{{ __('global.goal') }}</th>
                                    <th>{{ __('global.cardStartDate') }}</th>
                                    <th>{{ __('global.cardEndDate') }}</th>
                                    <th>{{__('global.status')}}</th>
                                    <th>{{__('global.file')}}</th>
                                    <th>{{__('global.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($guests as $u)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$u->name}}</td>
                                        <td>{{$u->StateName($u->states_id)}}</td>
                                        <td>{{$u->number_of_guests}}</td>
                                        <td>{{$u->goal}}</td>
                                        <td>{{$u->start_time}}</td>
                                        <td>{{$u->end_time}}</td>
                                        <td>
                                            @if (json_decode($u->GuestsStatus($u->id))->status == 1)
                                                <div class="alert-success bg-alert">
                                                    {{json_decode($u->GuestsStatus($u->id))->message}}
                                                </div>
                                            @endif

                                            @if (json_decode($u->GuestsStatus($u->id))->status == 2)
                                                <div class="alert-info bg-alert">
                                                    {{json_decode($u->GuestsStatus($u->id))->message}}
                                                </div>
                                            @endif

                                            @if (json_decode($u->GuestsStatus($u->id))->status == 0)
                                                <div class="alert-danger bg-alert">
                                                    {{json_decode($u->GuestsStatus($u->id))->message}}
                                                </div>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{asset('guest/'.$u->file)}}" download="{{$u->file}}"><i class="fa fa-download"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('guests.destroy',$u->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    <a href="{{ route('guests.edit',$u->id) }}" type="button"
                                                       class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="if (confirm('Malumotlar o\'chishiga rozimisiz?')) { this.form.submit() } "><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $i ++
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
