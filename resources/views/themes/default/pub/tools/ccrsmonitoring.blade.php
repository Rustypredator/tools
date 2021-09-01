@extends('themes.default.pub.master')

@section('content')
    <div class="row">
        <div class="card bg-gradient-warning col-12" style="margin-top:25px;">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="fas fa-cog mr-1"></i>ComputerCraft - RefinedStorage Monitoring</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <p>
                    If you already have a key, paste it below to access your settings.<br/>
                    otherwise click the button to create a new one.<br/>
                    <br/>
                    To Activate the monitoring, install <a>this</a> program on your ComputerCraft computer and put the key in the first line. Then start the Program of course.
                </p>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline btn-danger" onclick="genkey()">Generate new Key</button>
                    </div>
                    <input class="form-control" type="text" id="ccrsm_key" name="ccrsm_key" value=""/>
                    <div class="input-group-append">
                        <button class="btn btn-outline btn-success" onclick="sendKey()">Send Key (Login)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('client-js')
<script>
    $('#ccrsm_key').on("change", function() {
        //Load settings or something
        console.log("stuff")
    });
</script>
<script>
    function genkey() {
        requestdata = "_token=" + '{{csrf_token()}}' + "&uc=true&lc=true&nr=true&sc=true&length=32&amount=1"
        $.ajax
        (
            {
                type: 'POST',
                url: '/api/tools/pwgen/generatePasswords',
                data: requestdata,
                cache: false,
                beforeSend: function() {},
                success: function(data) {
                    console.log(data)
                    //response = JSON.parse(data)
                    passwords = data.generatedPasswords[0];
                    $('#ccrsm_key').val(passwords);
                }
            }
        )
    }
</script>
@stop
