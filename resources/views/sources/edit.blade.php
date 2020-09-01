@extends('layouts.admin')
@section('content')

<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Lead Source</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a>Dashboard</a></li>
                    <li class="active">Lead Source</li>
                </ol>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <form method="POST" @if(isset($data)) action="{{url('sources/'.$data->id)}}" @else
                                action="{{url('sources')}}" @endif>
                                {{csrf_field()}}
                                @if(isset($data))
                                @method('PATCH')
                                @endif
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="form-body">
                                    <h3 class="box-title m-t-40">Widget Details</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Widget Name</label>
                                                <input required type="text" class="form-control" placeholder="Widget Name"
                                                    value="@if(isset($data)){{$data->name}}@endif" name="name">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Default Country</label>
                                                <select class="form-control" name="country_id" required>
                                                    <option value="1" @if(isset($data->country_id) &&
                                                        $data->country_id == "1")
                                                        selected @endif>Egypt</option>
                                                    <option value="2" @if(isset($data->country_id) &&
                                                        $data->country_id == "2")
                                                        selected @endif>Saudi arabia</option>
                                                    <option value="3" @if(isset($data->country_id) &&
                                                        $data->country_id == "3")
                                                        selected @endif>United Kingdom</option>
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
                                                <select class="form-control" name="product_id" required>
                                                    @foreach($products as $value)
                                                    <option value="{{$value->id}}" @if(isset($data->product_id) &&
                                                        $data->product_id == $value->id)
                                                        selected @endif>{{$value->title}}</option>
                                                    @endforeach
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
                                                <select class="form-control" name="widget_type" id="widget_type"
                                                    required>
                                                    <option value="icon"  @if(isset($data->widget_type) &&
                                                        $data->widget_type == 'icon')
                                                        selected @endif>Icon Button</option>
                                                    <option value="text" @if(isset($data->widget_type) &&
                                                        $data->widget_type == 'text')
                                                        selected @endif>Text Button</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Alignment</label>
                                                <select class="form-control" name="alignment" required>
                                                    <option value="right" @if(isset($data->alignment) &&
                                                        $data->alignment == 'right')
                                                        selected @endif>Right</option>
                                                    <option value="left" @if(isset($data->alignment) &&
                                                        $data->alignment == 'left')
                                                        selected @endif>Left</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Primary Color <li class="mdi mdi-filter fa-fw"></li></label><br>
                                                <input class="form-control " name="primary" type="color" value="@if(isset($data)){{$data->primary}}@endif"
                                                    id="primary-color">
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Color<li class="mdi mdi-filter fa-fw"></li></label><br>
                                                <input class="form-control" name="secondary" type="color"
                                                    value="@if(isset($data)){{$data->secondary}}@endif" id="secondary-color">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-body" id="icon-settings">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="box-title m-t-40">Icon Button Settings</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>Icon Shape</label><br>
                                                    <div class="col-md-4">
                                                        <input type="radio" name="icon_type" value="mdi mdi-phone fa-fw"
                                                            @if(isset($data->icon_type) &&
                                                            $data->icon_type == 'mdi mdi-phone fa-fw')
                                                            checked @endif>
                                                        <li class="mdi mdi-phone fa-fw" style="font-size:30px"></li>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="radio" name="icon_type"
                                                            value="mdi mdi-cellphone-android fa-fw" @if(isset($data->icon_type) &&
                                                            $data->icon_type == 'mdi mdi-cellphone-android fa-fw')
                                                            checked @endif>
                                                        <li class="mdi mdi-cellphone-android fa-fw"
                                                            style="font-size:30px"></li>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="radio" name="icon_type"
                                                            value="mdi mdi-headset fa-fw" @if(isset($data->icon_type) &&
                                                            $data->icon_type == 'mdi mdi-headset fa-fw')
                                                            checked @endif>
                                                        <li class="mdi mdi-headset fa-fw" style="font-size:30px"></li>
                                                    </div>
                                                    <label style="margin-top:20px">Bubble Switch</label><br>
                                                    <div class="col-md-4">
                                                        <input type="radio" name="bubble" value="on" class="text-large" @if(isset($data->bubble) &&
                                                        $data->bubble == 'on')
                                                        checked @endif>
                                                        On
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="radio" name="bubble" value="off"
                                                            class="text-large" @if(isset($data->bubble) &&
                                                            $data->bubble == 'off')
                                                            checked @endif> Off
                                                    </div>
                                                    <div class="form-group shoutout-bubble">
                                                        <label style="margin-top:20px">Shoutout Bubble Line 1
                                                        </label><span class="text-small text-muted"> (40 Characters
                                                            Max)</span><br>
                                                        <input class="form-control" name="bubble_line_1" id="bubble-line-1" type="text" value="@if(isset($data)){{$data->bubble_line_1}}@endif" placeholder="@if(isset($data)){{$data->bubble_line_1}}@endif">
                                                    </div>
                                                    <div class="form-group shoutout-bubble">
                                                        <label style="margin-top:20px">Shoutout Bubble Line 2
                                                        </label><span class="text-small text-muted"> (40 Characters
                                                            Max)</span><br>
                                                        <input class="form-control" name="bubble_line_2" id="bubble-line-2" type="text" value="@if(isset($data)){{$data->bubble_line_2}}@endif" placeholder="@if(isset($data)){{$data->bubble_line_2}}@endif">
                                                    </div>
                                                </div>

                                                <!--/span-->
                                            </div>
                                            <div class="row shoutout-bubble">
                                                <div class="col-md-4">
                                                    <label>Bubble BG Color <li class="mdi mdi-filter fa-fw"></li>
                                                    </label><br>
                                                    <input class="form-control" name="bubble_bg_color" id="bubble-bg-color" type="color" value="@if(isset($data)){{$data->bubble_bg_color}}@endif">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Text Color<li class="mdi mdi-filter fa-fw"></li></label><br>
                                                    <input class="form-control" name="bubble_text_color" id="bubble-text-color" type="color" value="@if(isset($data)){{$data->bubble_text_color}}@endif">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="button-review">
                                                <div class="button-circle">
                                                    <div class="buttonround" title="Chat now">
                                                        <li class="mdi mdi-phone fa-fw" id="x-icon" style=""></li>
                                                        <div class="buttonround_tooltip">
                                                            <p id="b-l-1">Want to talk to an expert?</p>
                                                            <p id="b-l-2">Our Team is 60 Second Away From You!</p>
                                                            <div class="buttonround_tooltip_arrow">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body" id="text-settings" style="display:none">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="box-title m-t-40">Text Button Settings</h3>
                                            <hr>
                                            <div class="row">
                                                <!--/span-->
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label style="margin-top:20px">Call to action text </label><span
                                                            class="text-small text-muted"> (25 Characters
                                                            Max)</span><br>
                                                        <input class="form-control" name="text_text" id="text_text" value="@if(isset($data)){{$data->text_text}}@endif" type="text" placeholder="@if(isset($data)){{$data->text_text}}@endif">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="margin-top:20px">Corner Roundness </label><span
                                                            class="text-small text-muted"> (in px "50 px
                                                            Max")</span><br>
                                                        <input class="form-control" name="text_round" type="number" id="text_round" value="@if(isset($data)){{$data->text_round}}@endif" placeholder="@if(isset($data)){{$data->text_round}}@endif">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-review" style="postion:relative">
                                                <div class="chat-text">
                                                    <p class="text-text">TALK TO EXPERT NOW!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <h3 class="box-title m-t-40">Form Settings</h3>
                                    <hr>
                                    <div class="row">
                                        <!--/span-->
                                        <div class="col-md-12">
                                            <h4 class="font-bold">Fields</h4>

                                            <div class="col-md-3">
                                                <input class="d-inline" name="fields[]" type="checkbox" value="name" @if(isset($data->fields) && in_array("name", $data->fields[])) checked @endif><span> Name</span><br>
                                            </div>
                                            <div class="col-md-3">
                                                <input class="d-inline" name="fields[]" type="checkbox" value="email" @if(isset($data->fields) && in_array("email", $data->fields[])) checked @endif><span> Email</span><br>
                                            </div>
                                            <div class="col-md-3">
                                                <input class="d-inline" name="fields[]" type="checkbox" value="custom1" @if(isset($data->fields) && in_array("custom1", $data->fields[])) checked @endif><span> Custom Field
                                                    01</span><br>
                                            </div>
                                            <div class="col-md-3">
                                                <input class="d-inline" name="fields[]"  type="checkbox" value="custom2" @if(isset($data->fields) && in_array("custom2", $data->fields[])) checked @endif><span> Custom Field
                                                    02</span><br>
                                            </div>
                                            <div class="form-group">
                                                <label style="margin-top:20px">Custom Field 01 Title </label><span
                                                    class="text-small text-muted"> (20 Characters Max)</span><br>
                                                <input class="form-control" name="custom_lable_1" type="text"
                                                 value="@if(isset($data)){{$data->custom_lable_1}}@endif" placeholder="@if(isset($data)){{$data->custom_lable_1}}@endif">
                                            </div>
                                            <div class="form-group">
                                                <label style="margin-top:20px">Custom Field 02 Title </label><span
                                                    class="text-small text-muted"> (20 Characters Max)</span><br>
                                                <input class="form-control" name="custom_lable_2" type="text"
                                                value="@if(isset($data)){{$data->custom_lable_2}}@endif" placeholder="@if(isset($data)){{$data->custom_lable_2}}@endif">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-body" style="margin-top:20px">
                                    <div class="form-actions text-right">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save
                                        </button>
                                        <button type="reset" class="btn btn-dark">Cancel</button>
                                    </div>
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
console.log('mmmmmmmmmmmmmmm');

$("#widget_type").change(function() {
    console.log('hhh');
    if (this.value == "text") {
        $("#text-settings").show("swing");
        $("#icon-settings").hide("swing");
    } else {
        $("#icon-settings").show("swing");
        $("#text-settings").hide("swing");
    }
});

$('#primary-color').on('input', function(e) {
    $(".buttonround").css("background-color", this.value);
    $(".chat-text").css("background", this.value);
});
$('#secondary-color').on('input', function(e) {
    $("#x-icon").css("color", this.value);
    $(".text-text").css("color", this.value);
});

$('input[type=radio][name=icon_type]').change(function() {
    // alert(this.value);
    $("#x-icon").removeClass().addClass(this.value);
});

$('input[type=radio][name=bubble]').change(function() {
    // alert(this.value);
    if (this.value == "on") {
        $(".buttonround_tooltip").show("swing");
        $(".shoutout-bubble").show("swing");
    } else {
        $(".buttonround_tooltip").hide("swing");
        $(".shoutout-bubble").hide("swing");
    }
});

$('#bubble-line-1').on('input', function(e) {
    $("#b-l-1").html(this.value);
});
$('#bubble-line-2').on('input', function(e) {
    $("#b-l-2").html(this.value);
});
$('#bubble-bg-color').on('input', function(e) {
    $(".buttonround_tooltip").css("background-color", this.value);
    $(".buttonround_tooltip_arrow").css("border-color", "transparent "+ this.value);
});
$('#bubble-text-color').on('input', function(e) {
    $(".buttonround_tooltip").css("color", this.value);
});

$('#text_text').on('input', function(e) {
    $(".text-text").html(this.value);
});
$('#text_round').on('input', function(e) {
    $(".chat-text").css("border-radius", this.value+"px "+this.value+"px "+"0px 0px");
});
</script>
@endsection
@section('js')

@endsection
