<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>Click the link below to reset your password:</p>
    <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}">Reset Password</a>
</body>
</html>
