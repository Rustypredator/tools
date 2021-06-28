@extends('themes.default.pub.master')

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
                <form class="form" action="" method="post">
                    <label for="uc">Include Uppercase Chars?</label>
                    <input class="form-control" name="uc" type="checkbox" @if ($pwgen_uc) checked @endif/>
                    <label for="lc">Include Lowercase Chars?</label>
                    <input class="form-control" name="lc" type="checkbox" @if ($pwgen_lc) checked @endif/>
                    <label for="nr">Include Numbers?</label>
                    <input class="form-control" name="nr" type="checkbox" @if ($pwgen_nr) checked @endif/>
                    <label for="sc">Include Special Chars?</label>
                    <input class="form-control" name="sc" type="checkbox" @if ($pwgen_sc) checked @endif/>
                    <label for="length">Define the Length of your Password(s)</label>
                    <input class="form-control" name="length" type="numeric" value="{{$pwgen_length}}"/>
                    <label for="batch">Select how many Passwords you want</label>
                    <select name="batch" class="form-control">
                        <option value="1" @if ($pwgen_amount == 1) selected @endif>1</option>
                        <option value="5" @if ($pwgen_amount == 5) selected @endif>5</option>
                        <option value="10" @if ($pwgen_amount == 10) selected @endif>10</option>
                        <option value="15" @if ($pwgen_amount == 15) selected @endif>15</option>
                        <option value="50" @if ($pwgen_amount == 50) selected @endif>50</option>
                        <option value="100" @if ($pwgen_amount == 100) selected @endif>100</option>
                    </select>
                    <input type="submit" class="btn btn-block btn-success"/>
                </form>
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
                    <th></th>
                    <th>Password</th>
                </thead>
                <tbody>
                    @if (empty($pwgen_generated))
                        <tr><td colspan="2"><div class="alert alert-error"><i class="fa fa-lg fa-times-circle"></i> There was an Error with your Input! Please try again!</div></td></tr>
                    @else
                        @foreach ( $pwgen_generated as $pw )
                        <tr><td></td><td>{{$pw}}</td></tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
