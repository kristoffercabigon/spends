<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Attempt</title>
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

            <div style="background-color: #fff; padding: 20px; text-align: center; justify-content: center; align-items: center;">
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-4">Login Attempt</h1>
                <p style="font-size: 18px; color: #4a5568; margin-bottom: 24px;">
                    There have been five unsuccessful login attempts trying to access Admin Portal with the email address:
                </p>
                <div class="text-center mb-6">
                    <span style="display: inline-block; background-color: #fff; color: white !important; padding: 10px 20px; border-radius: 5px; font-size: 25px; text-decoration: none; font-weight: bold;">
                        {{ $admin_email }}
                    </span>
                </div>
                <p style="font-size: 18px; color: #4a5568; margin-bottom: 24px;">
                    This login attempt was recorded on {{ $admin_throttleTime }} from the IP address {{ $admin_ipAddress }}.
                </p>
                <p style="font-size: 18px; color: #4a5568;">
                    If this was you and you have simply forgotten your password, you may request a password reset by selecting "Forgot Password" on the login modal.
                </p>
            </div>

            <div style="background-color: #1aa514; padding: 30px;"></div>

        </div>
    </div>
</body>
</html>
