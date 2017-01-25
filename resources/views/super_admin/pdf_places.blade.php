<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super admin</title>

    <style>

        body {
            padding-top: 10px;
            background-color: #E5E9ED;
        }

        .restList {
            margin: 20px 15% 0 15%;
        }

        .restList .restaurant {
            padding-left: 10px;
            padding-right: 10px;
            background-color: white;
            border-top: 2px solid #ff6600;
            margin-bottom: 40px;
            height: 120px;
        }
        .restList .restaurant .name {
            font-size: 25px;
            color: #ff6600;
        }
        .restList .restaurant .selectAdmin {
            height: 20px;
        }

        .restList .restaurant a{
            text-decoration: none;
        }

    </style>
</head>
<body>
    <div class="restList">
    @foreach($restaurants as $restaurant)
        <div class="restaurant">
            <a target="_blank" href="{{ url('/').'/#/'.$restaurant->location->city->name.'/'.$restaurant->name.'/'.$restaurant->id }}">
                <div class="name">{{ $restaurant->name }}<span>, {{ $restaurant->support_id }}</span></div>
            </a>
            <div class="addressPart">
                <div class="addressGroup">
                    <span>{{ $restaurant->address }}</span>
                </div>
                <div class="addressGroup">
                    <span>{{ $restaurant->mobile }}</span>
                </div>
                <div class="addressGroup">
                    <span>{{ $restaurant->email }}</span>
                </div>
            </div>
            <div>
                <select class="selectAdmin">
                    <option {{ $restaurant->group_admin ? '' : 'selected' }} value="">Select Admin</option>
                    @foreach($group_admins as $admin)
                        <option {{ $restaurant->group_admin_id == $admin['id'] ? 'selected' : '' }} value="{{ $admin['id'] }}">{{ $admin['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endforeach
    </div>
</body>
</html>