{{ include('layouts/header.php', {title:'Détails de la réservation'})}}
    <section class="reservation-result-section">
        <div class="confirmation-container">
            <div class="confirmation-header">
                <h1>Détails de la réservation <span>{{booking.booking_id}}</span></h1>
                <h2>Du client <span>{{booking.client_name}} {{booking.client_surname}}</span></h2>
                <!-- <h1>Modifier la réservation numéro {{booking.booking_id}} de {{booking.client_name}} {{booking.client_surname}}</h1> -->
            </div>
            <div class="confirmation-text">
                <div class="value-confirmation"><p>ID de réservation: <span>{{booking.booking_id}}</span></p></div>
                <div class="value-confirmation"><p>Nom du client: <span>{{booking.client_name}}</span></p></div>
                <div class="value-confirmation"><p>Prénom du client: <span>{{booking.client_surname}}</span></p></div>
                <div class="value-confirmation"><p>Email du client: <span>{{booking.client_email}}</span></p></div>
                <div class="value-confirmation"><p>Téléphone du client: <span>{{booking.client_phone}}</span></p></div>
                <div class="value-confirmation"><p>Date d'arrivée: <span>{{booking.check_in_date}}</span></p></div>
                <div class="value-confirmation"><p>Heure d'arrivée: <span>{{booking.check_in_time}}</span></p></div>
                <div class="value-confirmation"><p>Date de retour: <span>{{booking.check_out_date}}</span></p></div>
                <div class="value-confirmation"><p>Heure de retour: <span>{{booking.check_in_time}}</span></p></div>
                <div class="value-confirmation"><p>Type de voiture: <span>{{booking.car_type}}</span></p></div>
                <div class="value-confirmation"><p>Marque de voiture: <span>{{booking.car_make}}</span></p></div>
                <div class="value-confirmation"><p>Modèle de voiture: <span>{{booking.car_model}}</span></p></div>
                <div class="value-confirmation"><p>Couleur de voiture: <span>{{booking.car_color}}</span></p></div>
            </div>
            <div class="confirmation-links">
                {% if session.privilege_id == 1 or session.privilege_id == 2 or session.privilege_id == 3 %} 
                    <a href="{{base}}/bookings" class="btn btn-box details">Retour à la liste</a>
                {% endif %} 
                <a href="{{base}}/booking/edit?id={{booking.booking_id}}" class="btn btn-box details">Modifier</a>
                <a href="{{ base }}/booking/generate-pdf?id={{booking.booking_id}}" class="btn btn-box details">Imprimer</a>

            </div>
        </div>
{{ include('layouts/footer.php')}}
