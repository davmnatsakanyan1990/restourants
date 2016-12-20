<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <p><span  style="font-weight: bold">Name: </span><span>{{ $request->name }}</span></p>
    <p><span  style="font-weight: bold">Address: </span><span>{{ $request->address }}</span></p>
    <p><span  style="font-weight: bold">Phone Number: </span><span>{{ $request->phoneNumber }}</span></p>
    <p><span  style="font-weight: bold">Description: </span><span>{{ $request->description }}</span></p>
    <p><span  style="font-weight: bold">Website: </span><span>{{ $request->website }}</span></p>
    <p><span  style="font-weight: bold">E-mail: </span><span>{{ $request->email }}</span></p>
</body>
</html>
