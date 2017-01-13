@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-push-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">Set a new goal for {{$date}}.</div>
                    <hr>
                    <form action="{{ url("/goal") }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-inline text-center">
                            <div class="input-group">
                                <label for="goal" class="sr-only">Goal</label>
                                <div class='input-group'>
                                    <input type='text' class="form-control" id='goal' name="goal" value="" placeholder="365"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>

                    </form>
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
