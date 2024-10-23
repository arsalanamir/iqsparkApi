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
            background: url('/images/background.jpeg') no-repeat center center; /* Use absolute URL */
            background-size: cover;
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
            margin-top: 197px;
            color: #000;
        }

        .score {
            font-size: 40px;
            font-weight: bold;
            margin-top: 68px;
            color: #000;
        }

        .presented-by {
            font-size: 14px;
            margin-top: 83px;
            color: #000;
            text-transform: uppercase;
            margin-left: 594px;
        }

        .serial {
            margin-top: -17px;
            font-weight: bold;
            margin-left: 775px;
            position: relative;
            top: 24px;
        }
    </style>
</head>

<body>
    <?php
    // Generate a random 6-digit number
    $randomNumber = random_int(100000, 999999);
    ?>
    <div class="certificate-container">
        <div class="certificate-content">
            <div class="serial">{{ $randomNumber }}</div>
            <div class="name">{{ $name }}</div>
            <div class="score">{{ $percentage }}</div>
            <div class="presented-by">iqspark.org</div>
        </div>
    </div>
</body>

</html>
