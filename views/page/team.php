<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Équipe</title>
</head>
<body>
    {{ include('layouts/header.php', {title:'À propos'})}}
    <div class="error_container">
    <div class="error_text">
        <div class="error_container_title">
            La page: Équipe
        </div>
        
        <div class="error_container_subtitle">
        Désolé, mais la page est en mode développement
        </div>
        <div class="error_container_btn">
            <a href="{{base}}/home" class="header-box_btn deals-link">Retour à la page principale</a>
        </div>
    </div>
    <div class="error_img">
        <img src="{{asset}}img/404/development.jpg" alt="developement_img">
    </div>
</div>
    {{ include('layouts/footer.php')}}
</body>
</html>