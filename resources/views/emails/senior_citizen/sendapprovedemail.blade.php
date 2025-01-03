<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status</title>
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
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-4">Application Status</h1>
                <p style="font-size: 18px; color: #4a5568; margin-bottom: 24px;">
                    Hello {{ $firstName }} {{ $lastName }}! Your application status for your account with osca ID: {{ $oscaId }} and email: {{ $email }} has been approved.
                </p>
                <p style="font-size: 18px; color: #4a5568; margin-bottom: 24px;">
                    You can keep track of the ongoing pension distributions on the announcement page. See if your barangay is included.
                </p>
            </div>

            <div style="background-color: #1aa514; padding: 30px;"></div>

        </div>
    </div>
</body>
</html>
