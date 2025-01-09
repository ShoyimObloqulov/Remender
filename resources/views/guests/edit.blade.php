@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('cruds.guests.title')}} {{__('global.edit')}}</h1>
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

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="color-palette-set" style="margin: 12px;">
                    <div class="bg-purple color-palette" style="padding: 10px"><span>Taxrirlash paytida Faylni qayta kirish kerak.</span></div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" method="POST" action="{{route('guests.update',$guest->id)}}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group {{ $errors->has('name') ? "has-error":"" }}">
                            <label for="">Delegatsiya nomi</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Enter Name"
                                value="{{$guest->name}}">
                            @if($errors->has('name'))
                            <span class="error help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Davlat</label>
                            <select class="form-control select2" style="width: 100%;" name="states_id">
                                <option value="{{$guest->states_id}}">{{$guest->StateName($guest->states_id)}}</option>
                                @foreach ($state as $item)
                                @if ($guest->states_id != $item->id)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group {{ $errors->has('number_of_guests') ? "has-error":"" }}">
                            <label for="">Delegatsiya azolar soni</label>
                            <input type="text" class="form-control" name="number_of_guests" id=""
                                placeholder="Delegatsiya azolar soni" value="{{$guest->number_of_guests}}">
                            @if($errors->has('number_of_guests'))
                            <span class="error help-block">{{ $errors->first('number_of_guests') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Kelishdan maqsad</label>
                            <textarea class="form-control" name="goal" rows="3"
                                placeholder="Enter ...">{{$guest->goal}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Kelish vaqti:</label>
                            <div class="input-group" id="reservationdate" data-target-input="nearest">
                                <input type="text" value="{{$guest->start_time}}" name="start_time" class="form-control" data-target="#reservationdate" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ketish vaqti:</label>
                            <div class="input-group" id="reservationdate1" data-target-input="nearest">
                                <input type="text" name="end_time" value="{{$guest->end_time}}" class="form-control" data-target="#reservationdate1" />
                                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Dastur Fayli</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="" name="file" accept=".pdf,.word" >
                                    <label class="custom-file-label" for="">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection
