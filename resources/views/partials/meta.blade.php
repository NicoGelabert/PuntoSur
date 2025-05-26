@props([
    'title' => 'Demo Restaurantes',
    'description' => 'Esto es una demo de cómo podría quedar un sitio pensado para hostelería, con menúes, descripción de comidas, información sobre alérgenos',
    'keywords' => 'restaurantes, bares, comidas',
    'canonical' => url('/'),
    'type' => 'website',
])

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ is_array($keywords) ? implode(', ', $keywords) : $keywords }}">
<link rel="canonical" href="{{ $canonical }}">
