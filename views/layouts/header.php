<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{asset}}css/style.css">
    {% if scripts is not empty %}
        {% for js in scripts %}
            <script src="{{asset}}js/{{js}}" defer></script>
        {% endfor %}
    {% endif %}
</head>
<body>
    <nav>
        <div class="logo">
            <div class="logo-img"><a href="{{base}}/home"><img src="{{asset}}img/nav/logo.jpg" alt="logo_img"></a></div>
            <h2>Deluxe Location</h2>
        </div>
        {% if isError is empty %}
            {{ include('layouts/nav.php')}}
        {% endif %}
    </nav>
<main>