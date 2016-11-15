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

                                                <form role="form" action="#">
                                                    <div class="form-group">
                                                        <label class="control-label">Restaurant Name</label>
                                                        <input type="text" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Mobile Number</label>
                                                        <input type="text" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Address</label>
                                                        <input type="text" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Cuisine</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Type Of Place</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Services</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Site</label>
                                                        <input type="text" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Price</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">City</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Location</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value="AL">Alabama</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Mode</label>
                                                        <select class="form-control select2me" data-placeholder="Select...">
                                                            <option value="AL">mode1</option>
                                                            <option value="WY">mode2</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group working-hours">
                                                        <label class="control-label">Working Hours</label>

                                                        <ul class="col-md-12">
                                                            <li>
                                                                <label for="">Mon:</label>
                                                                <input type="checkbox" class="form-control"/>
                                                                <input type="text" class="form-control"/>
                                                                <label for="">to</label>
                                                                <input type="text" class="form-control"/>
                                                            </li>
                                                            <li>
                                                                <label for="">Tue:</label>
                                                                <input type="checkbox" class="form-control"/>
                                                                <input type="text" class="form-control"/>
                                                                <label for="">to</label>
                                                                <input type="text" class="form-control"/>
                                                            </li>
                                                            <li>
                                                                <label for="">Wed:</label>
                                                                <input type="checkbox" class="form-control"/>
                                                                <input type="text" class="form-control"/>
                                                                <label for="">to</label>
                                                                <input type="text" class="form-control"/>
                                                            </li>
                                                            <li>
                                                                <label for="">Thu:</label>
                                                                <input type="checkbox" class="form-control"/>
                                                                <input type="text" class="form-control"/>
                                                                <label for="">to</label>
                                                                <input type="text" class="form-control"/>
                                                            </li>
                                                            <li>
                                                                <label for="">Fri:</label>
                                                                <input type="checkbox" class="form-control"/>
                                                                <input type="text" class="form-control"/>
                                                                <label for="">to</label>
                                                                <input type="text" class="form-control"/>
                                                            </li>
                                                            <li>
                                                                <label for="">Sat:</label>
                                                                <input type="checkbox" class="form-control"/>
                                                                <input type="text" class="form-control"/>
                                                                <label for="">to</label>
                                                                <input type="text" class="form-control"/>
                                                            </li>
                                                            <li>
                                                                <label for="">Sun:</label>
                                                                <input type="checkbox" class="form-control"/>
                                                                <input type="text" class="form-control"/>
                                                                <label for="">to</label>
                                                                <input type="text" class="form-control"/>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                    <div class="margiv-top-10">
                                                        <a href="#" class="btn green">
                                                            Save Changes
                                                        </a>
                                                        <a href="#" class="btn default">
                                                            Cancel
                                                        </a>
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

    </div>
@endsection