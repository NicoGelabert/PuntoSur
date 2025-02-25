<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    </head>
    <body>
        <h3>Clients</h3>
        <ul>
            @foreach ($clients as $client)
            <li><a href="{{ route('client.view', $client->slug) }}"><p>{{$client->full_name}}</p></a></li>
            @endforeach
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