<!DOCTYPE html>
<html>
<head>
    <title>User Register</title>
</head>
<body>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <h1>User</h1>
    <input type="text" name="email" placeholder="Nhập địa chỉ email">
    <input type="text" name="email" placeholder="Nhập địa chỉ email">
    <input type="password" name="password" placeholder="Nhập mật khẩu">
    <button type="submit">Đăng nhập</button>
</form>
</body>
</html>
