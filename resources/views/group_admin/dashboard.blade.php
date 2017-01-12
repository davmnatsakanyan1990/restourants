@extends('group_admin.layouts.index')
@section('styles')

@endsection
@section('content')
<div class="restList">
    <div class="filters">
        <div class="filterTitle">Filters</div>
        <form class="clearElement" method="get" action="{{ url('group_admin/dashboard') }}">
            <div class="radioGroup floatLeft">
                <input {{ request('status') && request('status') == 'all' ? 'checked' : !request('status') ? 'checked' : '' }} id="radio1" type="radio" name="status" value="all"  class="floatLeft">
                <label for="radio1" class="floatLeft radioText">All</label>
                <div class="check"><div class="inside"></div></div>
            </div>
            <div class="radioGroup floatLeft">
                <input {{ request('status') == 'call_back' ? 'checked' : ''}} id="radio2" type="radio" name="status" value="call_back" class="floatLeft">
                <label for="radio2" class="floatLeft radioText">Call back</label>
                <div class="check"><div class="inside"></div></div>
            </div>
            <div class="radioGroup floatLeft">
                <input {{ request('status') == 'deleted' ? 'checked' : ''}} id="radio3" type="radio" name="status" value="deleted" class="floatLeft">
                <label for="radio3" class="floatLeft radioText">Deleted</label>
                <div class="check"><div class="inside"></div></div>
            </div>
            <div class="radioGroup floatLeft">
                <input {{ request('status') == 'client' ? 'checked' : ''}} id="radio4" type="radio" name="status" value="client" class="floatLeft">
                <label for="radio4" class="floatLeft radioText">Client</label>
                <div class="check"><div class="inside"></div></div>
            </div>
            <button class="apply" type="submit">Apply</button>
        </form>
    </div>
    @foreach($restaurants->items() as $restaurant)
    <div class="restaurant">
        <div class="topPart clearElement">
            <div class="name floatLeft">{{ $restaurant->name }}</div>
            @if($restaurant->plan_id != 2)
            <select class="floatRight place_status" name="status" data-id="{{ $restaurant->id }}">
                <option {{ is_null($restaurant->status) ? 'selected' : '' }} value="">Select Status</option>
                <option {{ $restaurant->status == 'call_back' ? 'selected' : '' }} value="call_back">Call Back</option>
                <option {{ $restaurant->status == 'deleted' ? 'selected' : '' }} value="deleted">Deleted</option>
            </select>
            @endif
        </div>
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
                    @if($restaurant->email)
                        <span>{{ $restaurant->email }}</span>
                    @else
                        <span class="greenColor pointer addEmail">Add</span>
                    @endif
                    <span class="addingEmail">
                        <input type="text" placeholder="write here">
                        <button class="cancel">Cancel</button>
                        <button class="save" data-place_id="{{ $restaurant->id }}">Save</button>
                    </span>
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
            <a href="{{ url('group_admin/place/cover/'.$restaurant->id) }}"> <button class="changeCover floatRight">Change cover image</button></a>
            <i class="fa fa-chevron-down more" aria-hidden="true"></i>
        </div>
        <div class="comments hide">
            <div class="commentName">Notes</div>
            <textarea placeholder="write your note here"></textarea>
            <div class="clearElement">
                <button class="addComment floatRight" data-place_id="{{ $restaurant->id }}">Add note</button>
            </div>
            <div class="commentMain style-3"><i class="{{ count($restaurant->notes) > 0 ? 'fa fa-pencil' : '' }}" aria-hidden='true'></i>{{ count($restaurant->notes) > 0 ? $restaurant->notes[0]['text'] : '' }}</div>
            <div data-place_id="{{ $restaurant->id }}" class="viewAll"><a>View All</a></div>
        </div>
    </div>
    @endforeach
        {{ $restaurants->appends(['status'=> $status])->links() }}
</div>
@endsection

@section('scripts')
    <script src="/group_admin/scripts/notes.js" type="text/javascript"></script>
@endsection
