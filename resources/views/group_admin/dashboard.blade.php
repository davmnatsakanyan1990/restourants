@extends('group_admin.layouts.index')
@section('styles')

@endsection
@section('content')
<div class="restList">
    <div class="restaurant">
        <div class="name">Restaurant name</div>
        <div class="addressPart">

            <div class="addressGroup">
                <i class="fa fa-map-marker" aria-hidden="true" style="font-size: 25px;"></i>
                <span>Address</span>
            </div>
            <div class="addressGroup">
                <i class="fa fa-phone" aria-hidden="true" style="font-size: 23px;"></i>
                <span>+45454 5454 5454</span>
            </div>
            <div class="addressGroup">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>something@gmail.com</span>
            </div>
        </div>
        <div class="clearElement">
            <button class="changeCover floatRight">Change cover image</button>
            <i class="fa fa-chevron-down more" aria-hidden="true"></i>
        </div>
        <div class="comments hide">
            <div class="commentName">Comments</div>
            <textarea></textarea>
            <div class="clearElement">
                <button class="addComment floatRight">Add comment</button>
            </div>
            <div class="commentMain">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consequuntur
                debitis et, non perferendis rem sapiente ut. Accusantium, mollitia voluptatum!</div>
            <div class="viewAll"><a>View All</a></div>
        </div>
    </div>


</div>
@endsection
