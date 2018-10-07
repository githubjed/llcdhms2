@extends('admin.master')

@section('content')

            <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
        
        <!-- <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div> -->

         <div class="row" style="padding-top:20px;">
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-teal panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-blue"></em>
                            <div class="large">58</div>
                            <div class="text-muted" style="color:#59a3ff;">Employee</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-blue panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-user-md color-teal"></em>
                            <div class="large">15</div>
                            <div class="text-muted" style="color:#1ebfae;">Doctors</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-stethoscope color-orange"></em>
                            <div class="large">35</div>
                            <div class="text-muted" style="color:#f3b72e;">Nurse</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-red panel-widget ">
                        <div class="row no-padding"><em class="fa fa-xl fa-user color-red"></em>
                            <div class="large">8</div>
                            <div class="text-muted" style="color:#f12c3c;">Clerk</div>
                        </div>
                    </div>
                </div>
            </div>
           

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Monthly Income Overview s
                        <!-- <ul class="pull-right panel-settings panel-button-tab-right">
                            <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                                <em class="fa fa-cogs"></em>
                            </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <ul class="dropdown-settings">
                                            <li><a href="#">
                                                <em class="fa fa-cog"></em> Settings 1
                                            </a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">
                                                <em class="fa fa-cog"></em> Settings 2
                                            </a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">
                                                <em class="fa fa-cog"></em> Settings 3
                                            </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul> -->
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            {!! $chart->html() !!}
                            <!-- <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Monthly Patient Overview 
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            {!! $areaspline_chart->html() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
    {!! $areaspline_chart->script() !!}
            
            <!-- <div class="col-sm-12">
                <p class="back-link">Developed by <a href="#">Jendy Manatad</a></p>
            </div> -->
@endsection
