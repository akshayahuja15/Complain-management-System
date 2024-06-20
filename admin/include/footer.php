<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer with Creative CSS</title>
    <style>
        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer .copyright {
            font-weight: bold;
            font-size: 18px;
        }

        .footer .copyright:before {
            content: "\2022"; /* Unicode for a bullet point */
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy;</b> CAMPUS CARE All rights reserved.
        </div>
    </div>
</body>
</html>
