<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Reminder</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        /* Table wrapper for background image */
        .email-wrapper {
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("images/email-background.jpeg") }}'); /* Laravel asset() helper */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 50px 0;
        }
        /* Dark overlay for readability */
        .overlay {
            background-color: rgba(0, 0, 0, 0.6); /* Dark overlay */
            height: 100%;
            padding: 50px 0;
        }
        /* Email container styles */
        .email-container {
            background-color: rgba(255, 255, 255, 0.9); /* Light background with opacity */
            border-radius: 8px;
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px; /* Adjust as necessary */
        }
        h3 {
            font-size: 30px;
            font-weight: bold;
            color: #ff9900; /* Vibrant color for the heading */
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Text shadow for better contrast */
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            text-align: left;
            color: #333; /* Dark text for readability */
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 25px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-size: 16px;
            margin: 20px 0;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            color: #ddd;
        }
    </style>
</head>
<body>
    <!-- Email wrapper with background image -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="email-wrapper">
                <!-- Overlay to darken the background and make the text readable -->
                <div class="overlay">
                    <div class="email-container">
                        <!-- Logo -->
                        <a href="https://iqspark.org/test">
                            <img src="{{ asset('images/logo/iq-logo.png') }}" alt="Logo" class="logo"> <!-- Laravel asset() helper for logo -->
                        </a>
                        
                        <h3>Payment Reminder</h3>

                        <p>Dear {{$name}},</p>

                        <p>This is a reminder to make your payment to get your outstanding IQ result.</p>

                        <table>
                            <tr>
                                <th>Completion Date</th>
                                <td>{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</td>
                            </tr>
                            <tr>
                                <th>Amount Due</th>
                                <td>$8</td>
                            </tr>
                        </table>

                        <p class="text-center">
                            <a href="https://iqspark.org/test" class="btn btn-primary btn-lg" style="background-color: #ff9900 !important; color: #ffffff !important;">Get the result</a>
                        </p>

                        <p>If you have any questions or need assistance, feel free to reach out to our support team. We're here to help!</p>

                        <p>Thank you for your prompt attention to this matter.</p>

                        <p>Best regards,<br><a href="https://iqspark.org/test">iqspark.org</a></p>

                        <div class="footer">
                            <p>&copy; 2024 iqspark.org. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
