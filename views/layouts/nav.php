<div class="page-links">
    <a class="nav-btn" href="{{ base }}/page/about">À propos</a>
    <a class="nav-btn" href="{{ base }}/page/catalog">Catalogue</a>
    <a class="nav-btn" href="{{ base }}/page/team">Équipe</a>
    <a class="nav-btn" href="{{ base }}/page/blog">Blog</a>
    {% if session.privilege_id == 1 or session.privilege_id == 2 %} 
    <div class="dropdown">
        <a class="dropdown-btn">Admin/Manager</a>
        <div class="dropdown-content">
            <a href="{{ base }}/bookings">Réservations</a>
            <a href="{{ base }}/manager/clients">Clients</a>
            <a href="{{ base }}/manager/activity">Journal de bord</a>
            <a href="{{ base }}/manager/cars">Voitures</a>
        </div>
    </div>
    {% endif %}
</div>
<div class="contact-us">
    {% if  guest %}
        <a class="contact-btn" href="{{base}}/login">Authentification</a>
    {% endif %} 
      
    {% if guest is empty %}
        <p class="greet-user">Bonjour, <span>{{ session.name }}</span></p>
        <a class="contact-btn" href="{{base}}/logout">Déconnexion</a>
    {% endif %}
    
</div>
