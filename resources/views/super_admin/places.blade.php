@extends('super_admin.layouts.index')

@section('content')
    {{--<div class="col-sm-9 col-sm-offset-3">
        @foreach ($restaurants as $restaurant)
            </br>
            {{ $restaurant->name }}
        @endforeach
    </div>

    {{ $restaurants->links() }}--}}
    <div class="restList col-sm-9 col-sm-offset-2">
        <div class="filters">
            <div class="filterTitle">Filters</div>
            <form class="clearElement" method="get" action="{{ url('super_admin/places/all') }}">
                <select class="floatLeft" name="city" style="margin-right: 10px;">
                    <option {{ request('city') && request('city')== 'all' ? 'selected' : '' }} value="all">All</option>
                    @foreach($cities as $c)
                        <option {{ request('city') && request('city')==$c['id'] ? 'selected' : '' }} value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                    @endforeach
                </select>
                <select class="floatLeft selectAdmin" name="admin">
                    <option value="">Select Admin</option>
                    <option>oper1</option>
                </select>
                <div class="radioGroup floatLeft">
                    <input id="radio1" type="radio" name="status" value="all" {{ request('status') && request('status') == 'all' ? 'checked' : !request('status') ? 'checked' : '' }} class="floatLeft">
                    <label for="radio1" class="floatLeft radioText">All</label>
                    <div class="check"><div class="inside"></div></div>
                </div>
                <div class="radioGroup floatLeft">
                    <input id="radio2" type="radio" name="status" value="loggedIn" {{ request('status') && request('status') == 'loggedIn' ? 'checked' : '' }} class="floatLeft">
                    <label for="radio2" class="floatLeft radioText">Logged in</label>
                    <div class="check"><div class="inside"></div></div>
                </div>
                <button class="apply" type="submit">Apply</button>
            </form>
        </div>
        @foreach($restaurants as $restaurant)
            <div class="restaurant">
                <a target="_blank" href="{{ url('/').'/#/'.$restaurant->location->city->name.'/'.$restaurant->name.'/'.$restaurant->id }}">
                    <div class="name">{{ $restaurant->name }}<span>, {{ $restaurant->support_id }}</span></div>
                </a>

                <div class="clearElement">
                    <div class="addressPart floatLeft">
                        <div class="addressGroup">
                            <i class="fa fa-map-marker" aria-hidden="true" style="font-size: 25px;"></i>
                            <span>{{ $restaurant->address }}</span>
                        </div>
                        <div class="addressGroup">
                            <i class="fa fa-phone" aria-hidden="true" style="font-size: 23px;"></i>
                            <span>{{ $restaurant->mobile }}</span>
                        </div>
                        <div class="addressGroup">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>{{ $restaurant->email }}</span>
                        </div>
                    </div>
                    @if($restaurant->getAttributes()['days_remaining'] == 'not_logged_in')
                        <div class="status floatRight">Not logged in</div>
                    @elseif($restaurant->getAttributes()['days_remaining'] == 'expired')
                        <div class="status floatRight">Expired</div>
                    @elseif($restaurant->getAttributes()['days_remaining'] == 'purchased')
                        <div class="status floatRight">Purchased</div>
                    @else
                        <div class="status floatRight">{{ $restaurant->getAttributes()['days_remaining'] }} days remain</div>
                    @endif
                </div>
                <div class="clearElement">
                    <select class="floatLeft selectAdmin">
                        <option {{ $restaurant->group_admin ? '' : 'selected' }} value="">Select Admin</option>
                        @foreach($group_admins as $admin)
                            <option {{ $restaurant->group_admin_id == $admin['id'] ? 'selected' : '' }} value="{{ $admin['id'] }}">{{ $admin['name'] }}</option>
                        @endforeach
                    </select>
                    <a> <button class="changeCover floatRight disable" data-place_id="{{ $restaurant->id }}">Save</button></a>
                    <div class="floatLeft loadingDiv">
                        <img src="/super_admin/images/load.gif" alt="">
                    </div>
                </div>
                {{--<div class="comments hide">
                    <div class="commentName">Notes</div>
                    <textarea placeholder="write your note here"></textarea>
                    <div class="clearElement">
                        <button class="addComment floatRight" data-place_id="{{ $restaurant->id }}">Add comment</button>
                    </div>
                    <div class="commentMain style-3"><i class='fa fa-pencil' aria-hidden='true'></i>{{ count($restaurant->notes) > 0 ? $restaurant->notes[0]['text'] : '' }}</div>
                    <div data-place_id="{{ $restaurant->id }}" class="viewAll"><a>View All</a></div>
                </div>--}}
            </div>
        @endforeach
        {{ $restaurants->appends(['city' => $city, 'status'=> $status])->links() }}
    </div>


@endsection
