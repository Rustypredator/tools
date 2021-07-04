@extends('themes.default.pub.master')

@section('plugins.bsSlider', true)

@section('content')
    <div class="row">
        <div class="card bg-gradient-warning col-12" style="margin-top:25px;">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="fas fa-cog mr-1"></i>Generator Settings</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="pwgen_sw_uc" @if(Cookie::get('pwgen_uc')) checked @endif>
                        <label class="custom-control-label" for="pwgen_sw_uc">Include Uppercase Chars?</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="pwgen_sw_lc" @if(Cookie::get('pwgen_lc')) checked @endif>
                        <label class="custom-control-label" for="pwgen_sw_lc">Include Lowercase Chars?</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="pwgen_sw_nr" @if(Cookie::get('pwgen_nr')) checked @endif>
                        <label class="custom-control-label" for="pwgen_sw_nr">Include Numbers?</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="pwgen_sw_sc" @if(Cookie::get('pwgen_sc')) checked @endif>
                        <label class="custom-control-label" for="pwgen_sw_sc">Include Special Chars?</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control">
                        <input type="numeric" class="form-control" id="pwgen_length" value="{{Cookie::get('pwgen_length') ?? 8}}"/>
                        <label for="pwgen_length">Define the Length of your Password(s)</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwgen_amount">Select how many Passwords you want</label>
                    <select name="pwgen_amount" id="pwgen_amount" class="custom-select">
                        <option value="1" @if (Cookie::get('pwgen_amount') == 1) selected @endif>1</option>
                        <option value="5" @if (Cookie::get('pwgen_amount') == 5) selected @endif>5</option>
                        <option value="10" @if (Cookie::get('pwgen_amount') == 10) selected @endif>10</option>
                        <option value="15" @if (Cookie::get('pwgen_amount') == 15) selected @endif>15</option>
                        <option value="50" @if (Cookie::get('pwgen_amount') == 50) selected @endif>50</option>
                        <option value="100" @if (Cookie::get('pwgen_amount') == 100) selected @endif>100</option>
                    </select>
                </div>
                <button onclick="genPassword()" class="btn btn-success btn-block">Generate Passwords</button>
            </div>
        </div>
        <div class="card bg-secondary col-12">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="fas fa-key mr-1"></i>Your Passwords</h3>
                <!-- card tools -->
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <table class="panel-body table table-hover table-striped">
                <thead>
                    <th>Password</th>
                    <th>Actions</th>
                </thead>
                <tbody id="generatedPasswordsTable">
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('client-js')
    <script>
        function genPassword() {
            template = '<tr><td colspan="2"><div class="alert alert-error"><i class="fa fa-lg fa-times-circle"></i> There was an Error with your Input! Please try again!</div></td></tr>';
            uc = false;
            lc = false;
            nr = false;
            sc = false;
            if($('#pwgen_sw_uc').is(":checked")) {
                uc = true;
            }
            if($('#pwgen_sw_lc').is(":checked")) {
                lc = true;
            }
            if($('#pwgen_sw_nr').is(":checked")) {
                nr = true;
            }
            if($('#pwgen_sw_sc').is(":checked")) {
                sc = true;
            }
            var length = $('#pwgen_length').val()
            var amount = $('#pwgen_amount').val()
            requestdata = "_token=" + '{{csrf_token()}}' + "&uc=" + uc + "&lc=" + lc + "&nr=" + nr + "&sc=" + sc + "&length=" + length + "&amount=" + amount
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
                        response = JSON.parse(data)
                        passwords = response.generatedPasswords;
                        console.log(passwords)
                        if(passwords.length < 1) {
                            $('#generatedPasswordsTable').innerHtml('<tr><td colspan="2"><div class="alert alert-error"><i class="fa fa-lg fa-times-circle"></i> There was an Error with your Input! Please try again!</div></td></tr>');
                        } else {
                            passwords.forEach(password => {
                                $('#generatedPasswordsTable').append('<tr><td style="word-break:break-all;">'+password+'</td><td><button class="btn btn-primary btn-sm" onclick="copyToClipboard(\"'+password+'\")"><i class="fas fa-clipboard"></i></button></td></tr>');
                            });
                        }
                    }
                }
            )
        }
        function copyToClipboard(text) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(text).select();
            document.execCommand("copy");
            $temp.remove();
            toastr["success"]("Copy", "Copied " + text + " to your clipboard.");
        }
    </script>
@stop
