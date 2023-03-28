@extends('themes.default.pub.master')

@section('content')
    <div class="row">
        <div class="card bg-gradient-warning col-12" style="margin-top:25px;">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="fas fa-cog mr-1"></i>String Reverser</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <textarea id="strInput" class="form-control" rows="4" onchange="reverse()">-- put your text here --</textarea>
                <br/>
                <textarea id="strOutput" class="form-control" rows="4">-- your reversed string will appear here --</textarea>
                <br/>
            </div>
        </div>
    </div>
@stop

@section('client-js')
<script>
    $("#strInput").on("change input paste keyup", function() {
        $("#strOutput").html(jQuery(this).val().split("").reverse().join(""));
    });
</script>
@stop
