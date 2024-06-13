<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <p>Hello {{ $data['name'] }},</p>
    
    <p>{{ $data['body'] }}</p>
    
    <p><a href="{{ $data['url'] }}">Click here to reset your password</a></p>
    
    <p>If you did not request a password reset, please ignore this email.</p>
    
    <p>Regards,</p>
    <p>Your Website Team</p>
</body>
</html>
