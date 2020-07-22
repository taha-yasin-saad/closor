@extends('layouts.admin')
@section('content')

<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Widget</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Widget</li>
                </ol>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form method="POST" @if(isset($data)) action="{{url('Widget/'.$data->id)}}" @else
                                action="{{url('Widget')}}" @endif>
                                {{csrf_field()}}
                                @if(isset($data))
                                @method('PATCH')
                                @endif
                                <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                                <div class="form-body">
                                    <h3 class="box-title m-t-40">Widget Details</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Widget Name</label>
                                                <input required type="text" class="form-control"
                                                    placeholder="Widget #1"
                                                    value="@if(isset($data)){{$data->title}}@endif" name="title">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Country</label>
                                                <select class="form-control" name="" required>
                                                    <option value="">Country</option>
                                                    <option value="">Country</option>
                                                    <option value="">Country</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Widget Website</label>
                                                <input type="url" class="form-control" name="website"
                                                    placeholder="https://example.com"
                                                    value="@if(isset($data)){{$data->website}}@endif">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Product</label>
                                                <select class="form-control" name="" required>
                                                    <option value="">Product A</option>
                                                    <option value="">Product B</option>
                                                    <option value="">Product c</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-body">
                                    <h3 class="box-title m-t-40">Widget Display</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" name="" required>
                                                    <option value="">Icon Button</option>
                                                    <option value="">Text Button</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Alignment</label>
                                                <select class="form-control" name="" required>
                                                    <option value="">Right</option>
                                                    <option value="">Left</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Primary Color <li class="mdi mdi-filter fa-fw"></li></label><br>
                                                <input class="form-control color" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Color<li class="mdi mdi-filter fa-fw"></li></label><br>
                                                <input class="form-control color" type="text">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-body">
                                    <h3 class="box-title m-t-40">Icon Button Settings</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Icon Shape</label><br>
                                            <div class="col-md-4">
                                                <input type="radio"><li class="mdi mdi-phone fa-fw" style="font-size:30px"></li>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio"><li class="mdi mdi-cellphone-android fa-fw" style="font-size:30px"></li>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio"><li class="mdi mdi-headset fa-fw" style="font-size:30px"></li>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <label style="margin-bottom:20px">Bubble Switch</label><br>
                                            <div class="col-md-4">
                                                <input type="radio" class="text-large"> On
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio" class="text-large"> Off
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Primary Color <li class="mdi mdi-filter fa-fw"></li></label><br>
                                                <input class="form-control color" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Color<li class="mdi mdi-filter fa-fw"></li></label><br>
                                                <input class="form-control color" type="text">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-actions text-right">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save
                                    </button>
                                    <button type="reset" class="btn btn-dark">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<script>
    $('.color').colorpicker({});
</script>
@endsection
