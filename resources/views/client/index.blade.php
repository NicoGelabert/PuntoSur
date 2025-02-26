<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
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
            font-family: 'Adamina', serif;
            font-size: 2rem;
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            max-width: 400px;
        }

        li {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        a {
            text-decoration: none;
            font-weight: 600;
            display: block;
        }

        @media (min-width: 600px) {
            ul {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            li {
                width: 45%;
            }
        }
    </style>
</head>
<body>
    <h3>Clients</h3>
    <ul>
        @foreach ($clients as $client)
        <li>
            <a href="{{ route('client.view', $client->slug) }}">
                <p>{{$client->full_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</body>
</html>
