@extends('themes.default.pub.master')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card bg-gradient-warning" style="margin-top:25px;">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-cog mr-1"></i>ComputerCraft - RefinedStorage Monitoring</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        If you already have a key, paste it below and click "Send Key" to access your data.<br/>
                        otherwise click the button to create a new one.<br/>
                        <br/>
                        To Activate the monitoring, install <a href="#">this(pastebin.com)</a> program on your ComputerCraft computer and put the key in the first line. Then start the Program of course.<br/>
                        <br/>
                        <ul>Please note:
                            <li>to limit the amount of data i have to save, inactive systems will be cleared regularly (inactive for more than 7 days.)</li>
                            <li>if you want to download/delete all data of your system i have recorded, please send me an E-Mail or message me on discord.</li>
                        </ul>
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
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card bg-gradient-primary" id="card_basic_info" style="margin-top:25px;">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i>Basic info</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body" id="basic_info">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-gradient-primary" id="card_storage_overview" style="margin-top:25px;">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-hdd mr-1"></i>Storage overview</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body" id="storage_overview">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card bg-gradient-primary" id="card_tasks" style="margin-top:25px;">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-clipboard-check mr-1"></i>Tasks</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body" id="tasks">
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
    $('#card_basic_info').CardWidget('collapse')
    $('#card_storage_overview').CardWidget('collapse')
    $('#card_tasks').CardWidget('collapse')
</script>
<script>
    function genkey() {
        requestdata = "_token=" + '{{csrf_token()}}' + "&uc=true&lc=true&nr=true&sc=false&length=64&amount=1"
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
<script>
    function sendKey() {
        key = $('#ccrsm_key').val();
        requestdata = "_token=" + '{{csrf_token()}}' + "&key=" + key
        $.ajax
        (
            {
                type: 'POST',
                url: '/api/tools/ccrsmonitoring/reglog',
                data: requestdata,
                cache: false,
                beforeSend: function() {},
                success: function(data) {
                    console.log(data)
                }
            }
        )
    }
</script>
<script>
    function writeData(data) {
        processed = JSON.parse(data.processed)
        items = JSON.parse(data.items)
        $('#basic_info').innerHtml(data.processed)
        $('#storage_overview').innerHtml()
        $('#tasks').innerHtml()
    }
    function getData() {
        key = $('#ccrsm_key').val();
        requestdata = "_token=" + '{{csrf_token()}}' + "&key=" + key
        $.ajax
        (
            {
                type: 'POST',
                url: '/api/tools/ccrsmonitoring/data',
                data: requestdata,
                cache: false,
                beforeSend: function() {},
                success: function(data) {
                    writeData(data)
                }
            }
        )
    }
</script>
@stop
