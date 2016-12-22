<!DOCTYPE html>
<html>
<head>

</head>
<body>
<p><span  style="font-weight: bold">First Name: </span><span>{{ $request->first_name }}</span></p>
<p><span  style="font-weight: bold">Last Name: </span><span>{{ $request->last_name }}</span></p>
<p><span  style="font-weight: bold">Email: </span><span>{{ $request->email }}</span></p>
<p><span  style="font-weight: bold">Phone: </span><span>{{ $request->phone }}</span></p>
<p><span  style="font-weight: bold">Description: </span><span>{{ $request->description }}</span></p>
</body>
</html>