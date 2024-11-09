<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .email-wrapper {
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("images/email-background.jpeg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 50px 0;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.6); /* Dark overlay */
            height: 100%;
            padding: 50px 0;
        }
        .email-container {
            background-color: rgba(255, 255, 255, 0.9); /* Light background for content */
            border-radius: 8px;
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
        }
        h3 {
            font-size: 30px;
            font-weight: bold;
            color: #ff9900; /* Bright color for heading */
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Text shadow for better contrast */
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            text-align: left;
            color: #333;
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
                <!-- Overlay for readability -->
                <div class="overlay">
                    <div class="email-container">
                        <!-- Logo -->
                        <img src="{{ asset('images/logo/iq-logo.png') }}" alt="Logo" class="logo">

                        <h3>Payment Successful</h3>

                        <p>Dear {{ $name }},</p>

                        <p>Thank you for taking the time to complete the IQ test on our platform. We appreciate your participation and dedication to self-discovery and personal growth.</p>

                        <p>Your IQ Test Details:</p>
                        <ul>
                            <li>Total Questions: {{ $total_questions }}</li>
                            <li>Total Correct Answers: {{ $correct_attempts }}</li>
                            <li>Your IQ: {{ $percentage }}</li>
                        </ul>

                        <p>Your IQ: {{ $name }}</p>

                        <p>Moreover, you can download your IQ Certificate from the following link: <a href="{{ $pdfUrl }}" class="btn btn-primary btn-lg" style="background-color: #ff9900 !important; color: #ffffff !important;">Download Certificate</a></p>

                        <p>If you have any questions or need further assistance, please don't hesitate to contact us at support@iqspark.org. We're here to help.</p>

                        <p>Best regards,<br>Team iqspark.org</p>

                        <div class="footer">
                            <p>&copy; {{ date('Y') }} iqspark.org All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
