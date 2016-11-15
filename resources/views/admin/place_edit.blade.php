@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE CONTENT-->
            <div class="row profile">
                <div class="col-md-6">
                    <h2>Restaurant Info</h2>
                    <!--BEGIN TABS-->
                    <div class="tabbable tabbable-custom tabbable-full-width">
                        <div class="tab-content">
                            <!--tab_1_2-->
                            <div class="tab-pane active" id="tab_1_3">
                                <div class="row profile-account">
                                    <div class="col-md-12">
                                        <div class="tab-content">
                                            <div id="tab_1-1" class="tab-pane active">

                                                <form role="form" action="{{ url('admin/place/update') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label class="control-label">Restaurant Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $place['name'] }}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Mobile Number</label>
                                                        <input type="text" name="mobile" class="form-control" value="{{ $place['mobile'] }}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Address</label>
                                                        <input type="text" name="address" class="form-control" value="{{ $place['address'] }}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Cuisine</label>
                                                        <input type="hidden" id="select2_sample9" class="form-control select2" value="we, you">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Type Of Place</label>
                                                        <input type="hidden" id="select2_sample7" class="form-control select2" value="red, blue">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Services</label>
                                                        <input type="hidden" id="select2_sample5" class="form-control select2" value="red, blue">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Site</label>
                                                        <input type="text" name="site" class="form-control" value="{{ $place['site'] }}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Price</label>
                                                        <select class="form-control select2me" data-placeholder="Select..." name="cost">
                                                            <option value=""></option>
                                                            <option value="1" {{ $place['cost'] == 1 ? 'selected' : '' }}>$</option>
                                                            <option value="2" {{ $place['cost'] == 2 ? 'selected' : '' }}>$$</option>
                                                            <option value="3" {{ $place['cost'] == 3 ? 'selected' : '' }}>$$$</option>
                                                            <option value="4" {{ $place['cost'] == 4 ? 'selected' : '' }}>$$$$</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">City</label>
                                                        <select class="form-control select2me" data-placeholder="Select..." name="city">
                                                            <option value=""></option>
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city['id'] }}" {{ $city['id'] == $place['location']['city_id'] ? 'selected' : ''  }}>{{ $city['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Location</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value=""></option>
                                                            @foreach($locations as $location)
                                                                <option value="{{ $location['id'] }}" {{ $location['id'] == $place['location_id'] ? 'selected' : '' }}>{{ $location['name'] }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Mode</label>
                                                        <input type="hidden" id="select2_sample8" class="form-control select2" value="i, you">
                                                    </div>
                                                    <div class="form-group working-hours">
                                                        <label class="control-label">Working Hours</label>

                                                        <ul class="col-md-12">
                                                            <li>
                                                                <label for="">Mon:</label>
                                                                <input type="checkbox" name="mon" class="form-control" {{ ($place['workinghour']['mon'] != 'closed' && $place['workinghour']['mon'] != '') ? 'checked' : '' }}/>
                                                                <div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <label for="" style="width: auto">to</label>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Tue:</label>
                                                                <input type="checkbox" name="tue" class="form-control" {{ ($place['workinghour']['tue'] != 'closed' && $place['workinghour']['tue'] != '') ? 'checked' : '' }}/>
                                                                <div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <label for="" style="width: auto">to</label>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Wed:</label>
                                                                <input type="checkbox" name="wed" class="form-control" {{ ($place['workinghour']['wed'] != 'closed' && $place['workinghour']['wed'] != '') ? 'checked' : '' }}/>
                                                                <div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <label for="" style="width: auto">to</label>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Thu:</label>
                                                                <input type="checkbox" name="thu" class="form-control" {{ ($place['workinghour']['thu'] != 'closed' && $place['workinghour']['thu'] != '') ? 'checked' : '' }}/>
                                                                <div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <label for="" style="width: auto">to</label>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Fri:</label>
                                                                <input type="checkbox" name="fri" class="form-control" {{ ($place['workinghour']['fri'] != 'closed' && $place['workinghour']['fri'] != '') ? 'checked' : '' }}/>
                                                                <div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <label for="" style="width: auto">to</label>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Sat:</label>
                                                                <input type="checkbox" name="sat" class="form-control" {{ ($place['workinghour']['sat'] != 'closed' && $place['workinghour']['sat'] != '') ? 'checked' : '' }}/>
                                                                <div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <label for="" style="width: auto">to</label>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Sun:</label>
                                                                <input type="checkbox" name="sun" class="form-control" {{ ($place['workinghour']['sun'] != 'closed' && $place['workinghour']['sun'] != '') ? 'checked' : '' }}/>
                                                                <div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <label for="" style="width: auto">to</label>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="margin5">:</div>
                                                                    <div class="elementsBlock">
                                                                        <input type="text" name="mon_from" class="form-control"/>
                                                                        <div class="upDown">
                                                                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                    <div class="margiv-top-10">
                                                        <button type="submit" class="btn green">
                                                            Save Changes
                                                        </button>
                                                        <button class="btn default">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-md-9-->
                                </div>
                            </div>
                            <!--end tab-pane-->
                        </div>
                    </div>
                    <!--END TABS-->
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>


        @section('styles')

                <!-- BEGIN PAGE LEVEL STYLES -->
                <link rel="stylesheet" type="text/css" href="/admin/plugins/bootstrap-select/bootstrap-select.min.css"/>
                <link rel="stylesheet" type="text/css" href="/admin/plugins/select2/select2.css"/>
                <link rel="stylesheet" type="text/css" href="/admin/plugins/select2/select2-metronic.css"/>
                <link rel="stylesheet" type="text/css" href="/admin/plugins/jquery-multi-select/css/multi-select.css"/>

        @endsection

        @section('scripts')

            <!-- BEGIN PAGE LEVEL PLUGINS -->
                <script type="text/javascript" src="/admin/plugins/bootstrap-select/bootstrap-select.min.js"></script>
                <script type="text/javascript" src="/admin/plugins/select2/select2.min.js"></script>
                <script type="text/javascript" src="/admin/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
                <!-- END PAGE LEVEL PLUGINS -->
                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                <script src="/admin/scripts/core/app.js"></script>
                <script src="/admin/scripts/custom/components-dropdowns.js"></script>
                <!-- END PAGE LEVEL SCRIPTS -->/admin

                <script>
                    var services = ["red", "green", "blue", "yellow", "pink"];
                    jQuery(document).ready(function() {
                        // initiate layout and plugins
                        App.init();
                        ComponentsDropdowns.init();
                    });
                </script>
        @endsection

    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection