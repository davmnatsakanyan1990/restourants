@extends('admin.layouts.index')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE CONTENT-->
            <div class="row profile">
                <div class="col-md-8">
                    @if($admin->place->plan->id == 1)
                        <div class="curent-plan-block">
                            <div class="block">
                                @if($days_remaining)
                                    <h2>Your current plan:Free Trial</h2>
                                @else
                                    <h2>Your plan is expired</h2>
                                @endif
                                <div class="caunter">
                                    <div>
                                        <span class="num-block first-num {{ $days_remaining ? 'color-1' : 'color-2' }}">{{ $days_remaining }}</span>
                                        {{--<span>:</span>--}}
                                        {{--<span class="num-block last-num">0</span>--}}
                                        <span>Days remaing</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success">
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif
                    <h2>Restaurant Info</h2>
                    <!--BEGIN TABS-->
                    <div class="tabbable tabbable-custom tabbable-full-width">
                        <div class="tab-content" style="padding: 15px;">
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
                                                            @foreach($d as $wk_day => $value)
                                                            <li>
                                                                {{--<label for="">{{ $wk_day }}:</label>--}}
                                                                {{--<input type="checkbox" name="{{ $wk_day }}[index]" class="form-control" {{ ($value != 'Closed' && $value != '') ? 'checked' : '' }}/>--}}

                                                                @if($value == 'Closed' || $value == '')
                                                                <div class="first_part">
                                                                    <label for="">{{ $wk_day }}:</label>
                                                                    <input type="checkbox" name="{{ $wk_day }}[index]" class="form-control" />
                                                                    <div class="addingElement">
                                                                        <div class="counters">
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][1][from][hr]" class="form-control" value="00"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true" onClick="increment('{{ $wk_day }}[data][1][from][hr]',   'hours' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][1][from][hr]', 'hours')"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="margin5">:</div>
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][1][from][min]" class="form-control" value="00"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true" onClick="increment('{{ $wk_day }}[data][1][from][min]', 'minute' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][1][from][min]', 'minute')"></i>
                                                                                </div>
                                                                            </div>
                                                                            <label for="" style="width: auto">to</label>
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][1][to][hr]" class="form-control" value="00"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('{{ $wk_day }}[data][1][to][hr]', 'hours' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][1][to][hr]', 'hours')"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="margin5">:</div>
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][1][to][min]" class="form-control" value="00"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('{{ $wk_day }}[data][1][to][min]', 'minute' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][1][to][min]', 'minute')"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="addMore" title="add more time period" >
                                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                    @foreach($value as $k => $part)
                                                                     @if($k ==0)
                                                                         <div class="first_part">
                                                                            <label for="">{{ $wk_day }}:</label>
                                                                            <input type="checkbox" name="{{ $wk_day }}[index]" class="form-control" checked/>

                                                                     @endif

                                                                    <div class="addingElement {{ $k == 0 ? '' : 'customMargin' }}">
                                                                        <div class="counters">
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][{{ $k+1 }}][from][hr]" class="form-control" value="{{ $part['from']['hr'] }}"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true" onClick="increment('{{ $wk_day }}[data][{{ $k+1 }}][from][hr]',   'hours' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][{{ $k+1 }}][from][hr]', 'hours')"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="margin5">:</div>
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][{{ $k+1 }}][from][min]" class="form-control" value="{{ $part['from']['min'] }}"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true" onClick="increment('{{ $wk_day }}[data][{{ $k+1 }}][from][min]', 'minute' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][{{ $k+1 }}][from][min]', 'minute')"></i>
                                                                                </div>
                                                                            </div>
                                                                            <label for="" style="width: auto">to</label>
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][{{ $k+1 }}][to][hr]" class="form-control" value="{{ $part['to']['hr'] }}"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('{{ $wk_day }}[data][{{ $k+1 }}][to][hr]', 'hours' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][{{ $k+1 }}][to][hr]', 'hours')"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="margin5">:</div>
                                                                            <div class="elementsBlock">
                                                                                <input type="text" name="{{ $wk_day }}[data][{{ $k+1 }}][to][min]" class="form-control" value="{{ $part['to']['min'] }}"/>
                                                                                <div class="upDown">
                                                                                    <i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('{{ $wk_day }}[data][{{ $k+1 }}][to][min]', 'minute' )"></i>
                                                                                    <i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('{{ $wk_day }}[data][{{ $k+1 }}][to][min]', 'minute')"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @if($k == 0)
                                                                            <div class="addMore" title="add more time period" >
                                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                                            </div>
                                                                        @else
                                                                            <div class="addMore" title="add more time period" style="color: red;" onclick = "removePeriod(this)">
                                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                     @if($k ==0)
                                                                         </div>
                                                                     @endif
                                                                    @endforeach
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                            {{--<li>--}}
                                                                {{--<label for="">Tue:</label>--}}
                                                                {{--<input type="checkbox" name="tue[index]" class="form-control" {{ ($place['workinghour']['tue'] != 'closed' && $place['workinghour']['tue'] != '') ? 'checked' : '' }}/>--}}
                                                                {{--<div class="addingElement">--}}
                                                                    {{--<div class="counters">--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="tue[data][1][from][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][from][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][from][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="tue[data][1][from][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][from][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][from][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<label for="" style="width: auto">to</label>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="tue[data][1][to][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][to][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][to][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="tue[data][1][to][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('tue[data][1][to][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('tue[data][1][to][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="addMore" title="add more time period">--}}
                                                                        {{--<i class="fa fa-plus" aria-hidden="true"></i>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<label for="">Wed:</label>--}}
                                                                {{--<input type="checkbox" name="wed[index]" class="form-control" {{ ($place['workinghour']['wed'] != 'closed' && $place['workinghour']['wed'] != '') ? 'checked' : '' }}/>--}}
                                                                {{--<div class="addingElement">--}}
                                                                    {{--<div class="counters">--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="wed[data][1][from][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][from][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][from][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="wed[data][1][from][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][from][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][from][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<label for="" style="width: auto">to</label>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="wed[data][1][to][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][to][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][to][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="wed[data][1][to][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('wed[data][1][to][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('wed[data][1][to][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="addMore" title="add more time period">--}}
                                                                        {{--<i class="fa fa-plus" aria-hidden="true"></i>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}

                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<label for="">Thu:</label>--}}
                                                                {{--<input type="checkbox" name="thu[index]" class="form-control" {{ ($place['workinghour']['thu'] != 'closed' && $place['workinghour']['thu'] != '') ? 'checked' : '' }}/>--}}
                                                                {{--<div class="addingElement">--}}
                                                                    {{--<div class="counters">--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="thu[data][1][from][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][from][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][from][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="thu[data][1][from][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][from][min]', 'minute')"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][from][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<label for="" style="width: auto">to</label>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="thu[data][1][to][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][to][hr]', 'hours')"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][to][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="thu[data][1][to][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('thu[data][1][to][min]', 'minute')"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('thu[data][1][to][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="addMore" title="add more time period">--}}
                                                                        {{--<i class="fa fa-plus" aria-hidden="true"></i>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<label for="">Fri:</label>--}}
                                                                {{--<input type="checkbox" name="fri[index]" class="form-control" {{ ($place['workinghour']['fri'] != 'closed' && $place['workinghour']['fri'] != '') ? 'checked' : '' }}/>--}}
                                                                {{--<div class="addingElement">--}}
                                                                    {{--<div class="counters">--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="fri[data][1][from][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][from][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][from][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="fri[data][1][from][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][from][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][from][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<label for="" style="width: auto">to</label>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="fri[data][1][to][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][to][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][to][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="fri[data][1][to][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('fri[data][1][to][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('fri[data][1][to][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="addMore" title="add more time period">--}}
                                                                        {{--<i class="fa fa-plus" aria-hidden="true"></i>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<label for="">Sat:</label>--}}
                                                                {{--<input type="checkbox" name="sat[index]" class="form-control" {{ ($place['workinghour']['sat'] != 'closed' && $place['workinghour']['sat'] != '') ? 'checked' : '' }}/>--}}
                                                                {{--<div class="addingElement">--}}
                                                                    {{--<div class="counters">--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sat[data][1][from][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][from][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][from][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sat[data][1][from][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][from][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][from][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<label for="" style="width: auto">to</label>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sat[data][1][to][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][to][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][to][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sat[data][1][to][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sat[data][1][to][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sat[data][1][to][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="addMore" title="add more time period">--}}
                                                                        {{--<i class="fa fa-plus" aria-hidden="true"></i>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<label for="">Sun:</label>--}}
                                                                {{--<input type="checkbox" name="sun[index]" class="form-control" {{ ($place['workinghour']['sun'] != 'closed' && $place['workinghour']['sun'] != '') ? 'checked' : '' }}/>--}}
                                                                {{--<div class="addingElement">--}}
                                                                    {{--<div class="counters">--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sun[data][1][from][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][from][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][from][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sun[data][1][from][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][from][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][from][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<label for="" style="width: auto">to</label>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sun[data][1][to][hr]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][to][hr]', 'hours' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][to][hr]', 'hours')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="margin5">:</div>--}}
                                                                        {{--<div class="elementsBlock">--}}
                                                                            {{--<input type="text" name="sun[data][1][to][min]" class="form-control" value="00"/>--}}
                                                                            {{--<div class="upDown">--}}
                                                                                {{--<i class="fa fa-angle-up" aria-hidden="true"   onClick="increment('sun[data][1][to][min]', 'minute' )"></i>--}}
                                                                                {{--<i class="fa fa-angle-down" aria-hidden="true" onClick="decrement('sun[data][1][to][min]', 'minute')"></i>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="addMore" title="add more time period">--}}
                                                                        {{--<i class="fa fa-plus" aria-hidden="true"></i>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</li>--}}
                                                        </ul>

                                                    </div>
                                                    <div class="margiv-top-10">
                                                        <a href="{{ url('admin/dashboard') }}"> <button type="button" class="btn default">
                                                            Cancel
                                                        </button></a>
                                                        <button type="submit" class="btn green">
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                    <div class="images">
                                                        <h3 style="color: #ff7e00;">Cover images</h3>
                                                        <p>Upload images only: width:1920px, height:800px</p>
                                                        @foreach($cover_images as $image)
                                                            <div class="currentImage">
                                                                <img data-id ={{$image['id']}}  src="{{ asset('images/coverImages/'.$image['name']) }}" alt="">
                                                                <div class="removeImage">Remove</div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </form>
                                                {{--<form action="add_cover" method="post" enctype="multipart/form-data">--}}
                                                    {{--<div class="field" align="left">--}}
                                                        {{--<h3 style="color: #ff7e00;">Cover images</h3>--}}
                                                        {{--@foreach($cover_images as $image)--}}
                                                        {{--<div class="currentImage">--}}
                                                            {{--<img data-id ={{$image['id']}}  src="{{ asset('images/coverImages/'.$image['name']) }}" alt="">--}}
                                                            {{--<div class="removeImage">Remove</div>--}}
                                                        {{--</div>--}}
                                                        {{--@endforeach--}}
                                                        {{--<input class="inputfile" type="file" id="files" name="files[]" multiple />--}}
                                                        {{--<input class="upload" type="submit" name="submitBtn" value="Upload" />--}}
                                                    {{--</div>--}}
                                                {{--</form>--}}
                                            <!-- The file upload form used as target for the file upload widget -->
                                                <form id="fileupload" action="{{url('admin/place/add_cover')}}" method="POST" enctype="multipart/form-data">
                                                    <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                                    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                                    <div class="row fileupload-buttonbar">
                                                        <div class="col-lg-7">
                                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                                            <span class="btn btn-success fileinput-button">
                                                                <i class="glyphicon glyphicon-plus"></i>
                                                                <span>Add files...</span>
                                                                <input type="file" name="files[]" multiple>
                                                            </span>
                                                            <button type="submit" class="btn btn-primary start">
                                                                <i class="glyphicon glyphicon-upload"></i>
                                                                <span>Start upload</span>
                                                            </button>
                                                            <button type="reset" class="btn btn-warning cancel">
                                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                                <span>Cancel upload</span>
                                                            </button>

                                                            <!-- The global file processing state -->
                                                            <span class="fileupload-process"></span>
                                                        </div>
                                                        <!-- The global progress state -->
                                                        <div class="col-lg-5 fileupload-progress fade">
                                                            <!-- The global progress bar -->
                                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                            </div>
                                                            <!-- The extended global progress state -->
                                                            <div class="progress-extended">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                    <!-- The table listing the files available for upload/download -->
                                                    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                                </form>

                                            </div>
                                            <!-- The blueimp Gallery widget -->
                                            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                                                <div class="slides"></div>
                                                <h3 class="title"></h3>
                                                <a class="prev">‹</a>
                                                <a class="next">›</a>
                                                <a class="close">×</a>
                                                <a class="play-pause"></a>
                                                <ol class="indicator"></ol>
                                            </div>

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
@endsection


        @section('styles')

                <!-- BEGIN PAGE LEVEL STYLES -->
                <link rel="stylesheet" type="text/css" href="/admin/plugins/bootstrap-select/bootstrap-select.min.css"/>
                <link rel="stylesheet" type="text/css" href="/admin/plugins/select2/select2.css"/>
                <link rel="stylesheet" type="text/css" href="/admin/plugins/select2/select2-metronic.css"/>
                <link rel="stylesheet" type="text/css" href="/admin/plugins/jquery-multi-select/css/multi-select.css"/>

                    <!-- Bootstrap styles -->
                    {{--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">--}}
                    <!-- Generic page styles -->
                    <link rel="stylesheet" href="/admin/css/fileUpload/css/style.css">
                    <!-- blueimp Gallery styles -->
                    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
                    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
                    <link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload.css">
                    <link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload-ui.css">
                    <!-- CSS adjustments for browsers with JavaScript disabled -->
                    <noscript><link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload-noscript.css"></noscript>
                    <noscript><link rel="stylesheet" href="/admin/css/fileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>


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
                <!-- END PAGE LEVEL SCRIPTS -->

                <script>
                    //var services = ["red", "green", "blue", "yellow", "pink"];

                    jQuery(document).ready(function() {
                        // initiate layout and plugins
                        App.init();
                        ComponentsDropdowns.init();
                    });
                </script>
                <script src="/admin/scripts/myCustom/editPage.js"></script>


                <script id="template-upload" type="text/x-tmpl">
                {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-upload fade">
                        <td>
                            <span class="preview"></span>
                        </td>
                        <td>
                            <p class="name">{%=file.name%}</p>
                            <strong class="error text-danger"></strong>
                        </td>
                        <td>
                            <p class="size">Processing...</p>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                        </td>
                        <td>
                            {% if (!i && !o.options.autoUpload) { %}
                                <button class="btn btn-primary start" disabled>
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start</span>
                                </button>
                            {% } %}
                            {% if (!i) { %}
                                <button class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                </button>
                            {% } %}
                        </td>
                    </tr>
                {% } %}
                </script>
                <!-- The template to display files available for download -->
                <script id="template-download" type="text/x-tmpl">
                {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-download fade">
                        <td>
                            <span class="preview">
                                {% if (file.thumbnailUrl) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img width=80 height=auto src="{%=file.thumbnailUrl%}"></a>
                                {% } %}
                            </span>
                        </td>
                        <td>
                            <p class="name">
                                {% if (file.url) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                {% } else { %}
                                    <span>{%=file.name%}</span>
                                {% } %}
                            </p>
                            {% if (file.error) { %}
                                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                            {% } %}
                        </td>
                        <td>
                            <span class="size">{%=o.formatFileSize(file.size)%}</span>
                        </td>
                        <td>
                            {% if (file.deleteUrl) { %}
                                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete</span>
                                </button>

                            {% } else { %}
                                <button class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                </button>
                            {% } %}
                        </td>
                    </tr>
                {% } %}
                </script>

                <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
                <script src="/admin/scripts/fileUpload/js/vendor/jquery.ui.widget.js"></script>
                <!-- The Templates plugin is included to render the upload/download listings -->
                <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
                <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
                <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
                <!-- The Canvas to Blob plugin is included for image resizing functionality -->
                <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
                <!-- blueimp Gallery script -->
                <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
                <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
                <script src="/admin/scripts/fileUpload/js/jquery.iframe-transport.js"></script>
                <!-- The basic File Upload plugin -->
                <script src="/admin/scripts/fileUpload/js/jquery.fileupload.js"></script>
                <!-- The File Upload processing plugin -->
                <script src="/admin/scripts/fileUpload/js/jquery.fileupload-process.js"></script>
                <!-- The File Upload image preview & resize plugin -->
                <script src="/admin/scripts/fileUpload/js/jquery.fileupload-image.js"></script>
                <!-- The File Upload validation plugin -->
                <script src="/admin/scripts/fileUpload/js/jquery.fileupload-validate.js"></script>
                <!-- The File Upload user interface plugin -->
                <script src="/admin/scripts/fileUpload/js/jquery.fileupload-ui.js"></script>
                <!-- The main application script -->
                <script src="/admin/scripts/fileUpload/js/main.js"></script>
                <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
                <!--[if (gte IE 8)&(lt IE 10)]>
                <script src="/admin/scripts/fileUpload/js/cors/jquery.xdr-transport.js"></script>
                <![endif]-->

        @endsection



