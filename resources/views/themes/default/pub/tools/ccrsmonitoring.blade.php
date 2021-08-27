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
                    otherwise click the button to create a new one.
                </p>
                <button onclick="genkey()">Generate new Key</button>
                <input type="text" id="ccrsm_key" name="ccrsm_key" value=""/>
            </div>
        </div>
    </div>
@stop

@section('client-js')
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
