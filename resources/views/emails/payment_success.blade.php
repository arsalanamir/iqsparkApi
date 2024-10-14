<!DOCTYPE html>
<html>

<head>
    <title>Payment Successful</title>
</head>

<!DOCTYPE html>
<html>
    <head>
        <title>Payment Success</title>
    </head>
    <body>
        <h1>Payment Successful</h1>
        <p>Dear {{ $name }},</p>
        <p>Email: {{ $email }}</p>
    <p>Thank you for your payment. Your payment was successfully processed.</p>
    <p>Your performance IQ: {{ $percentage }}</p>

    <!-- Add a link to the PDF -->
    <p>You can download your detailed report by clicking on the link below:</p>
    <a href="{{ $pdfUrl }}">Download PDF Report</a>

    <p>Thanks for choosing us!</p>
</body>
</html>
