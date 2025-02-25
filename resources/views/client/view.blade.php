<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    </head>
    <body>
        <h3>{{$client->full_name}}</h3>
        <ul>
            <li>
                <span>Age</span>
                <p>{{ $client->age }}</p>
            </li>
            <li>
                <span>Phone Number</span>
                <p>{{ $client->phone_number }}</p>
            </li>
            <li>
                <span>Emergency Phone Number</span>
                <p>{{ $client->emergency_phone_number }}</p>
            </li>
            <li>
                <span>Town</span>
                <p>{{ $client->town }}</p>
            </li>
            <li>
                <span>Occupancy</span>
                <p>{{ $client->occupancy }}</p>
            </li>
            <li>
                <span>Email</span>
                <p>{{ $client->email }}</p>
            </li>
            <li>
                <span>Treatment booked</span>
                <p>{{ $client->treatment }}</p>
            </li>
            <li>
                <span>Are you sore at the moment? Name where in your body and describe kind of pain and for how long are you feeling this</span>
                <p>{{ $client->sore }}</p>
            </li>
            <li>
                <span>Any medications and other treatments done in the last 3 months? Name everyone, give details and duration please.</span>
                <p>{{ $client->medication }}</p>
            </li>
            <li>
                <span>Any allergies?</span>
                <p>{{ $client->allergies }}</p>
            </li>
            <li>
                <span>Name major medical background to know in the last 6 months: eg, cancer, heart failure, epilepsy, diabetes, injuries, surgeries, peace-maker or metal prostheses in your body, contagious skin disease, undiagnosed lumps, sebaceous cysts, current infection, haemorrhage or any other thing which comes to your mind about your health situation. Please mention dates, duration and treatments you do to help.</span>
                <p>{{ $client->medicalBackground }}</p>
            </li>
            <li>
                <span>Exercises or sports</span>
                <p>{{ $client->sports }}</p>
            </li>
            <li>
                <span>Current diet</span>
                <p>{{ $client->currentDiet }}</p>
            </li>
            <li>
                <span>Sleep patterns</span>
                <p>{{ $client->sleepPatterns }}</p>
            </li>
            <li>
                <span>Water Intake</span>
                <p>{{ $client->waterIntake }}</p>
            </li>
            <li>
                <span>If you are pregnant, mention pregnancy stage (weeks) and any medical considerations to know.</span>
                <p>{{ $client->pregnancy }}</p>
            </li>
            <li>
                <span>If you are going through menopause or perimenopause please describe symptoms related and any treatments you are doing or HRT.</span>
                <p>{{ $client->menopause }}</p>
            </li>
        </ul>
    </body>
</html>

<style>
    body{
        font-family: 'barlow', sans-serif;
    }
    h3{
        font-family: 'Adamina', serif;
        font-size: 2rem;
    }
</style>