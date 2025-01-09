@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('cruds.remenders.title')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('global.home')}}</a></li>
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
                            @can('remenders.create')
                                <a class="btn btn-primary" href="{{route('remenders.create')}}"><i
                                        class="fa fa-plus"></i> {{__('cruds.remenders.create')}}</a>
                            @endcan

                            <a href="{{ route('export.reminders') }}" class="btn btn-primary btn-sm float-right">
                                <i class="fa fa-file-excel"></i> Эксель
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('cruds.remenders.title')}}</th>
                                    <th>{{__('cruds.remenders.organization')}}</th>
                                    <th>{{__('global.status')}}</th>
                                    <th>{{__('global.time')}}</th>
                                    <th>{{__('cruds.remenders.people')}}</th>
                                    <th>{{__('global.phone')}}</th>

                                    @can('remenders.sendmessage')
                                        <th>{{__('global.message')}}</th>
                                    @endcan
                                    <th>{{__('global.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach($remenders as $remender)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{$remender->name}}</td>
                                        <td>{{$remender->desc}}</td>
                                        <td>
                                            @if($remender->RemenderTimeCompare($remender->date))
                                                <span class="badge badge-danger">@lang('cruds.remenders.endtime')</span>
                                            @else
                                                <span
                                                    class="badge badge-primary">@lang('cruds.remenders.starttime')</span>
                                            @endif
                                        </td>
                                        <td>{{$remender->date}}</td>

                                        <td>
                                            @foreach($remender->email as $r)
                                                <span class="badge badge-success py-2 px-3 my-1">{{ $r->email }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($remender->phone as $r)
                                                <span
                                                    class="badge badge-secondary py-2 px-3 my-1">{{ $r->phone }}</span>
                                            @endforeach
                                        </td>
                                        @can('remenders.sendmessage')
                                            <td>
                                                <form action="{{route('remenders.send',$remender->id)}}" method="POST">
                                                    @csrf
                                                    <p>{{$remender->RemenderEmail($remender->users_id)}}</p>
                                                    <button class="text-center btn btn-primary btn-sm" type="submit"><i
                                                            class="fa fa-paper-plane"></i> @lang('cruds.remenders.sendMessage')
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                        <td class="text-center">
                                            @can('remenders.delete')
                                                <form id="delete-form-{{ $remender->id }}"
                                                      action="{{ route('remenders.destroy', $remender->id) }}"
                                                      method="post">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <div class="btn-group">
                                                        @can('remenders.edit')
                                                            <a href="{{ route('remenders.edit', $remender->id) }}"
                                                               type="button" class="btn btn-info btn-sm">
                                                                @lang('global.edit')
                                                            </a>
                                                        @endcan
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="confirmDelete('{{ $remender->id }}')">
                                                            @lang('global.delete')
                                                        </button>
                                                    </div>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @php
                                        $i = $i + 1
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

@section('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '@lang("global.confirm_delete_title")',
                text: '@lang("global.confirm_delete_text")',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '@lang("global.confirm_yes")',
                cancelButtonText: '@lang("global.confirm_no")'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

    </script>
@endsection
