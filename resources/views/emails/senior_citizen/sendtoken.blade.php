<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-green-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8">
            
            <div class="mb-6 text-center">
                <div style="background-color: #1aa514; padding: 20px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ $message->embed($logoPath) }}" alt="OSCA Logo" style="display: block; margin: 0 auto; max-width: 240px; max-height: 100px;">
                </div>
            </div>

            <div style="background-color: #fff; padding: 20px; text-align: center;">
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-4">Password Reset</h1>
                <p style="font-size: 18px; color: #4a5568; margin-bottom: 24px;">
                    This is your token to reset your password:
                </p>
                <div class="flex items-center justify-center mb-6">
                    <a href="http://localhost:8000/reset-password?token={{ $token }}&email={{ urlencode($email) }}" style="display: inline-block; max-width: 50%; background-color: #ff4802; color: white; padding: 10px 20px; border-radius: 5px; font-size: 25px; text-decoration: none; font-weight: bold; overflow-wrap: break-word;">
                        {{ $token }}
                    </a>
                </div>
                <p style="font-size: 18px; color: #4a5568; margin-bottom: 24px;">
                    Click the token above to redirect to password reset form.
                </p>
                <p style="font-size: 18px; color: #4a5568; margin-bottom: 24px;">
                    This token will expire after 1 hour: {{ $expiresAt->format('l, F j, Y g:i A') }}
                </p>
            </div>

            <div style="background-color: #1aa514; padding: 30px;"></div>

        </div>
    </div>
</body>
</html>
