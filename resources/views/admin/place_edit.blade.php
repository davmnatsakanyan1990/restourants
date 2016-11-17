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
                                                        <select name="cuisins[]" id="select2_sample9" class="form-control select2" multiple="multiple">
                                                            @foreach($all_cuisins as $cuisin)
                                                                <option {{ count(collect($place['cuisins'])->whereIn('id', [$cuisin['id']])->all()) > 0 ? 'selected' : ''  }} value="{{ $cuisin['id'] }}">{{ $cuisin['name'] }}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Type Of Place</label>
                                                        <select name="types[]" id="select2_sample7" class="form-control select2" multiple="multiple">
                                                            @foreach($all_types as $type)
                                                                <option {{ count(collect($place['types'])->whereIn('id', [$type['id']])->all()) > 0 ? 'selected' : ''  }} value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Services</label>
                                                        <select name="services[]" id="select2_sample5" class="form-control select2" multiple="multiple">
                                                            @foreach($all_highlights as $highlight)
                                                                <option {{ count(collect($place['highlights'])->whereIn('id', [$highlight['id']])->all()) > 0 ? 'selected' : ''  }} value="{{ $highlight['id'] }}">{{ $highlight['name'] }}</option>
                                                            @endforeach
                                                        </select>
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
                                                            @foreach($all_cities as $city)
                                                                <option value="{{ $city['id'] }}" {{ $city['id'] == $place['location']['city_id'] ? 'selected' : ''  }}>{{ $city['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Location</label>
                                                        <select name="location" class="form-control select2me" data-placeholder="Select...">
                                                            <option value=""></option>
                                                            @foreach($locations as $location)
                                                                <option value="{{ $location['id'] }}" {{ $location['id'] == $place['location_id'] ? 'selected' : '' }}>{{ $location['name'] }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Mode</label>
                                                        <select name="categories[]" id="select2_sample8" class="form-control select2" multiple="multiple">
                                                            @foreach($all_categories as $category)
                                                                <option {{ count(collect($place['categories'])->whereIn('id', [$category['id']])->all()) > 0 ? 'selected' : ''  }} value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group working-hours">
                                                        <label class="control-label">Working Hours</label>

                                                        <ul class="col-md-12">
                                                            <li>
                                                                <label for="">Mon:</label>
                                                                <input type="checkbox" name="mon[index]" class="form-control" {{ ($place['workinghour']['mon'] != 'closed' && $place['workinghour']['mon'] != '') ? 'checked' : '' }}/>

                                                                <div class="addingElement">
                                                                    <div class="counters">
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="mon[data][1][from][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true" onClick="increment('mon[data][1][from][hr]',   'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('mon[data][1][from][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="mon[data][1][from][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true" onClick="increment('mon[data][1][from][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('mon[data][1][from][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <label for="" style="width: auto">to</label>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="mon[data][1][to][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('mon[data][1][to][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('mon[data][1][to][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="mon[data][1][to][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('mon[data][1][to][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('mon[data][1][to][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="addMore" title="add more time period" >
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Tue:</label>
                                                                <input type="checkbox" name="tue[index]" class="form-control" {{ ($place['workinghour']['tue'] != 'closed' && $place['workinghour']['tue'] != '') ? 'checked' : '' }}/>
                                                                <div class="addingElement">
                                                                    <div class="counters">
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="tue[data][1][from][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][from][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][from][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="tue[data][1][from][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][from][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][from][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <label for="" style="width: auto">to</label>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="tue[data][1][to][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][to][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][to][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="tue[data][1][to][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][to][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][to][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="addMore" title="add more time period">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Wed:</label>
                                                                <input type="checkbox" name="wed[index]" class="form-control" {{ ($place['workinghour']['wed'] != 'closed' && $place['workinghour']['wed'] != '') ? 'checked' : '' }}/>
                                                                <div class="addingElement">
                                                                    <div class="counters">
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="wed[data][1][from][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][from][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][from][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="wed[data][1][from][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][from][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][from][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <label for="" style="width: auto">to</label>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="wed[data][1][to][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][to][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][to][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="wed[data][1][to][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][to][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][to][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="addMore" title="add more time period">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>

                                                            </li>
                                                            <li>
                                                                <label for="">Thu:</label>
                                                                <input type="checkbox" name="thu[index]" class="form-control" {{ ($place['workinghour']['thu'] != 'closed' && $place['workinghour']['thu'] != '') ? 'checked' : '' }}/>
                                                                <div class="addingElement">
                                                                    <div class="counters">
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="thu[data][1][from][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][from][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][from][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="thu[data][1][from][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][from][min]', 'minute')"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][from][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <label for="" style="width: auto">to</label>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="thu[data][1][to][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][to][hr]', 'hours')"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][to][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="thu[data][1][to][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][to][min]', 'minute')"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][to][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="addMore" title="add more time period">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Fri:</label>
                                                                <input type="checkbox" name="fri[index]" class="form-control" {{ ($place['workinghour']['fri'] != 'closed' && $place['workinghour']['fri'] != '') ? 'checked' : '' }}/>
                                                                <div class="addingElement">
                                                                    <div class="counters">
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="fri[data][1][from][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][from][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][from][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="fri[data][1][from][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][from][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][from][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <label for="" style="width: auto">to</label>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="fri[data][1][to][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][to][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][to][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="fri[data][1][to][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][to][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][to][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="addMore" title="add more time period">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Sat:</label>
                                                                <input type="checkbox" name="sat[index]" class="form-control" {{ ($place['workinghour']['sat'] != 'closed' && $place['workinghour']['sat'] != '') ? 'checked' : '' }}/>
                                                                <div class="addingElement">
                                                                    <div class="counters">
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sat[data][1][from][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][from][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][from][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sat[data][1][from][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][from][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][from][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <label for="" style="width: auto">to</label>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sat[data][1][to][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][to][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][to][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sat[data][1][to][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][to][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][to][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="addMore" title="add more time period">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="">Sun:</label>
                                                                <input type="checkbox" name="sun[index]" class="form-control" {{ ($place['workinghour']['sun'] != 'closed' && $place['workinghour']['sun'] != '') ? 'checked' : '' }}/>
                                                                <div class="addingElement">
                                                                    <div class="counters">
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sun[data][1][from][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][from][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][from][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sun[data][1][from][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][from][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][from][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <label for="" style="width: auto">to</label>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sun[data][1][to][hr]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][to][hr]', 'hours' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][to][hr]', 'hours')"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="margin5">:</div>
                                                                        <div class="elementsBlock">
                                                                            <input type="text" name="sun[data][1][to][min]" class="form-control" value="00"/>
                                                                            <div class="upDown">
                                                                                <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][to][min]', 'minute' )"></i>
                                                                                <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][to][min]', 'minute')"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="addMore" title="add more time period">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i>
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
                    //var services = ["red", "green", "blue", "yellow", "pink"];

                    jQuery(document).ready(function() {
                        // initiate layout and plugins
                        App.init();
                        ComponentsDropdowns.init();
                    });
                </script>
                <script src="/admin/scripts/myCustom/editPage.js"></script>

        @endsection

    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection