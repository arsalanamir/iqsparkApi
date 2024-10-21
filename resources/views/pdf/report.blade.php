<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .certificate-container {
            width: 1000px;
            height: 700px;
            background: url('/images/background.jpeg') no-repeat center center; /* Temporary placeholder */
            background-size: cover; /* Ensure the image covers the area */
            position: relative;
        }

        .certificate-content {
            position: absolute;
            top: 20%;
            left: 10%;
            width: 80%;
            text-align: center;
        }

        .name {
            font-size: 36px;
            font-weight: bold;
            margin-top: 197px; /* Adjust as needed */
            color: #000;
        }

        .score {
            font-size: 40px;
            font-weight: bold;
            margin-top: 68px; /* Adjust as needed */
            color: #000;
        }

        .presented-by {
            font-size: 14px;
            margin-top: 83px; /* Adjust as needed */
            color: #000;
            text-transform: uppercase;
            margin-left: 594px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-content">
            <div class="name">{{ $name }}</div>
            <div class="score">{{ $percentage }}</div>
            <div class="presented-by">iqspark.org</div>
        </div>
    </div>
</body>

</html>
