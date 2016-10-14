@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Call Lists</h2>

        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.missedCall') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                <a href="{{ url('/api/store') }}"> 
                    <button type="button" class="btn btn-success">
                        <span class="fa fa-check"></span> Refresh
                    </button>
                </a>
            </div>

            <h2 class="panel-title">Call Lists</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Phone No.</th>
                        <th>Call Time</th>
                        <th>Caller Id</th>
                        <th>Phone Name</th>
                        <th>Source</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{--*/ $inc = 0  /*--}}
                    @foreach($missedData as $missed)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ ++$inc }}</div></td>
                        <td class="table-text">{{ $missed->phone_number }}</td>

                        <td class="table-text"> {{ $missed->date_time }}</td>
                        <td class="table-text">{{ $missed->caller_id }}</td>
                        <td class="table-text">{{ $missed->phone_number_name }}</td>
                        <td class="table-text">Tele-marketing Calls</td>
                        <td class="actions">
                            @if($missed->appointment_status)
                            <a href="{{ url('/apptsetting/index/marketingCall/'.$missed->id) }}" class="on-editing save-row disable_tag" title="Create Appointment"><i class="fa fa-calendar"></i></a>
                            @else
                            <a href="{{ url('/apptsetting/index/marketingCall/'.$missed->id) }}" class="on-editing save-row" title="Create Appointment"><i class="fa fa-calendar"></i></a>
                            @endif
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
@endsection