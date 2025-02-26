<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color:#FBFCFF;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 10px;
        }
        .social-icons {
            margin-top: 10px;
        }
        .social-icons a {
            margin: 0 5px;
            color: #ffffff;
            text-decoration: none;
            font-size: 20px;
        }
        .body {
            padding: 20px;
            line-height: 1.6;
            color: #333333;
        }
        .footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
    <title>onfirmation Email</title>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="https://chibalancetherapies.com/storage/common/chibalance_logo.png" alt="Chi Balance" class="logo">
        </div>

        <!-- Body -->
        <div class="body">
            <h3>Thank you for contacting us!</h3>
            <p>Hi {{ $contact->name }},</p>
            <p>
                We have received your information and will get back to you shortly. If you have any questions in the meantime, please feel free to reply to this email.
            </p>
            <p>Kind regards,</p>
            <p><strong>Yanina Pellegrino</strong><br><strong>Chi Balance Therapies</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© 2025 Chi Balance Therapies. All rights reserved.</p>
            <p>Email: <a href="mailto:chibalancetherapies@gmail.com">chibalancetherapies@gmail.com</a></p>
        </div>
    </div>
</body>
</html>
