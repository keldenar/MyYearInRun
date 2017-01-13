@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-push-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">You've Completed {{ $runs->sum('distance') }} miles of your {{$goal->goal_miles or 0}} mile goal.</div>
                    <hr>
                    <div class="text-center h4">Why don't you log a run!</div>
                    <form action="{{ url("/runs") }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-inline text-center">
                            <div class='input-group date' id="datetimepicker1">
                                <label for="runDate" class="sr-only">Run Date</label>
                                <input type='text' class="form-control" id='runDate' name="runDate" value="" placeholder="Date"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <div class="input-group">
                                <label for="distance" class="sr-only">Run Distance</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" id='distance' name="distance" value="" placeholder="Distance"/>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="runTime" class="sr-only">Run Time</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" id='runTime' name="runTime" value="" placeholder="Time HH:MM:SS"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>

                    </form>
@if (null !== $message)
                    <hr>
                    <div class="text-center h4">{{ $message }}</div>
                    <hr>
@endif
                    <div class="text-center"><a href="{{ url("/goal") }}">Change your goal for the year.</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-pull-8">
            <div class="panel panel-default">
                <div class="panel-heading">Runs this year.</div>
                <div class="panel-body">
@if(! $runs->isEmpty())
                        <div class="row">
                            <div class="col-md-4 text-left">Date</div>
                            <div class="col-md-4 text-center">Distance</div>
                            <div class="col-md-4 text-right">Duration</div>
                        </div>
    @foreach($runs as $run)

                    <div class="row">
                        <div class="col-md-4 text-left">{{$run->run_date}}</div>
                        <div class="col-md-4 text-center">{{$run->distance}} miles</div>
                        <div class="col-md-4 text-right">{{$run->convert($run->run_time)}}</div>
                    </div>
    @endforeach
@else
                    No Runs recorded yet
@endif
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            showTodayButton: true,
            format: "MM/DD/YYYY"
        });
    });
</script>

@endsection
