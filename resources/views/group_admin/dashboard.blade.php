@extends('group_admin.layouts.index')
@section('styles')

@endsection
@section('content')
<div class="restList">
    @foreach($restaurants as $restaurant)
    <div class="restaurant">
        <div class="name">{{ $restaurant->name }}</div>
        <div class="addressPart">

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
        <div class="clearElement">
            <button class="changeCover floatRight">Change cover image</button>
            <i class="fa fa-chevron-down more" aria-hidden="true"></i>
        </div>
        <div class="comments hide">
            <div class="commentName">Notes</div>
            <textarea placeholder="write your note here"></textarea>
            <div class="clearElement">
                <button class="addComment floatRight" data-place_id="{{ $restaurant->id }}">Add comment</button>
            </div>
            <div class="commentMain style-3">{{ count($restaurant->notes) > 0 ? $restaurant->notes[0]['text'] : '' }}</div>
            <div data-place_id="{{ $restaurant->id }}" class="viewAll"><a>View All</a></div>
        </div>
    </div>
    @endforeach
        {{ $restaurants->links() }}
</div>
@endsection

@section('scripts')
    <script src="/group_admin/scripts/notes.js" type="text/javascript"></script>
@endsection
