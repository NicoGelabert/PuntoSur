<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Barlow', sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h3 {
            font-family: 'Inter', sans-serif;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 600px;
            width: 100%;
        }

        li {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        span {
            font-weight: bold;
            font-size: 1rem;
        }

        p {
            margin: 0;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            ul {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <h3>{{$client->full_name}}</h3>
    <ul>
        <li><span>Age</span><p>{{ $client->age }}</p></li>
        <li><span>Phone Number</span><p>{{ $client->phone_number }}</p></li>
        <li><span>Emergency Phone Number</span><p>{{ $client->emergency_phone_number }}</p></li>
        <li><span>Town</span><p>{{ $client->town }}</p></li>
        <li><span>Occupancy</span><p>{{ $client->occupancy }}</p></li>
        <li><span>Email</span><p>{{ $client->email }}</p></li>
        <li><span>Treatment booked</span><p>{{ $client->treatment }}</p></li>
        <li><span>Are you sore at the moment?</span><p>{{ $client->sore }}</p></li>
        <li><span>Any medications in the last 3 months?</span><p>{{ $client->medication }}</p></li>
        <li><span>Any allergies?</span><p>{{ $client->allergies }}</p></li>
        <li><span>Medical background</span><p>{{ $client->medicalBackground }}</p></li>
        <li><span>Exercises or sports</span><p>{{ $client->sports }}</p></li>
        <li><span>Current diet</span><p>{{ $client->currentDiet }}</p></li>
        <li><span>Sleep patterns</span><p>{{ $client->sleepPatterns }}</p></li>
        <li><span>Water Intake</span><p>{{ $client->waterIntake }}</p></li>
        <li><span>Pregnancy details</span><p>{{ $client->pregnancy }}</p></li>
        <li><span>Menopause details</span><p>{{ $client->menopause }}</p></li>
    </ul>
</body>
</html>
