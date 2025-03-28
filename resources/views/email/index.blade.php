<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        /* Global Styles */
        body {
            font-family: "Poppins", sans-serif;
            background-color: #edf2f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Card Container */
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Header */
        h1 {
            color: #2d3748;
            margin-bottom: 15px;
            font-size: 26px;
        }

        /* Subtext */
        p {
            color: #4a5568;
            font-size: 16px;
            margin-bottom: 25px;
        }

        /* Verification Button */
        .button {
            display: inline-block;
            padding: 12px 20px;
            background: linear-gradient(135deg, #4f46e5, #5a67d8);
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }

        .button:hover {
            background: linear-gradient(135deg, #5a67d8, #4f46e5);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.3);
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #718096;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Hello, {{ $user->name }}! </h1>
        <h1>Verify Your Email</h1>
        <p>Please click the button to verify your email address.</p>
        
        <a href="{{ url(route('verify', ['id' => $user->remember_token])) }}" class="button">Verify Email</a>

        <p class="footer">Activity sir benjie.</p>
    </div>

</body>

</html>
