<!DOCTYPE html>
<html>
<head>
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

	<form action="{{url('/tab/cart/remove-qty')}}" method="post">
		@csrf

		<input type="text" name="foodId">
		<input type="submit" name="name">
	</form>

</body>
</html>