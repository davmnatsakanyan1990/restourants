@extends('super_admin.layouts.index')

@section('content')
    <div class="col-sm-9 col-sm-offset-3">
        @foreach ($restaurants as $restaurant)
            </br>
            {{ $restaurant->name }}
        @endforeach
    </div>

    {{ $restaurants->links() }}
@endsection
