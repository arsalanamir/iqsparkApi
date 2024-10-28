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
        <p>Dear {{ $name }},</p><br>
        <p>Thank you for taking the time to complete the IQ test on our platform. We appreciate your participation and dedication to self-discovery and personal growth.</p><br>
    <p>Your IQ Test Details</p>
    <p>Total Question: {{ $total_questions }}</p>
    <p>Total Correct Answers: {{ $correct_attempts }}</p>
    <p>Your IQ: {{ $percentage }}</p>
    <p>Your IQ: {{ $name }}</p><br>

    <!-- Add a link to the PDF -->
    <p>Moreover, You can download your IQ Certificate from the following link : <a href="{{ $pdfUrl }}">( link )</a></p>


    <p>If you have any questions or need further assistance, please don't hesitate to contact us at support@iqspark.org. We're here to help.</p><br>
    <p> Best Best regards,</p>
    <p> Team Iqspark.</p>
</body>
</html>


