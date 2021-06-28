@extends('themes.default.pub.master')

@section('content')
    <div class="row" style="margin-top:25px;">
        <div class="card bg-gradient-warning col-12">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="fas fa-hands-helping mr-1"></i>Welcome</h3>
                <!-- card tools -->
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                <p>
Welcome to my little collection of (hopefully) useful tools.
There are not many yet, but this collection will continue to grow because i make these tools whenever i need them.
If you have ideas for useful simple tools you haven't found yet on the internet, feel free to contact me: <a href="mailto:contact@rusty.info">E-Mail</a>

Feel free to browse a little and hopefully you will find something useful ;)
                </p>
            </div>
        </div>
    </div>
@stop

@section('client-js')
@stop
