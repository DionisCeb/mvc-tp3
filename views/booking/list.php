{{ include('layouts/header.php', {title:'Bookings'})}}

<section class="admin-interface">
        <div class="admin-container">
            <h1>Gestion des réservations</h1>

            <a href="{{base}}/booking/create" class="header-box_btn deals-link return-secondary-btn secondary-edit-btn">Nouvelle réservation</a>
            <table class="booking-list-table">
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date d'arrivée</th>
                    <th>L'heure d'arrivée</th>
                    <th>Date de retour</th>
                    <th>L'heure de retour</th>
                    <th>Type de voiture</th>
                    <th>Marque de voiture</th>
                    <th>Modèle de voiture</th>
                    <th>Couleur de la voiture</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                {% for booking in bookings %}
                <tr>
                    <td><a href="{{base}}/booking/show?id={{booking.booking_id}}">{{ booking.booking_id }}</a></td>
                    <td>{{booking.client_name}}</td>
                    <td>{{booking.client_surname}}</td>
                    <td>{{booking.client_email}}</td>
                    <td>{{booking.client_phone}}</td>
                    <td>{{booking.check_in_date}}</td>
                    <td>{{booking.check_in_time}}</td>
                    <td>{{booking.check_out_date}}</td>
                    <td>{{booking.check_out_time}}</td>
                    <td>{{booking.car_type}}</td>
                    <td>{{booking.car_make}}</td>
                    <td>{{booking.car_model}}</td>
                    <td>{{booking.car_color}}</td>
                    
                    <td><a href="{{base}}/booking/edit?id={{booking.booking_id}}"><img src="{{asset}}img/icons/edit.svg" class="icon-action icon-green " alt="Modifier"></a></td>
                    <td><button data-id="{{booking.booking_id}}" class="btn-delete"><img src="{{asset}}img/icons/delete.svg" class="icon-action icon-red" alt="Supprimer"></button></td>
                </tr>
                {% endfor %}
            </table>
        </div>
    </section>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            var id = this.getAttribute('data-id');

            
            // Show confirmation popup
            var confirmation = confirm('Etes-vous sûr de vouloir supprimer cette réservation?');   
            if (confirmation) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{base}}/booking/delete', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');               
                xhr.onload = function() {
                    if (xhr.status === 200) {                      
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {                      
                            alert(response.message);
                        } else {                         
                            alert(response.message);      
                        }
                        location.reload()
                    } else {
                        // Handle the error response here
                        alert("Erreur lors de la suppression de la réservation");
                    }
                };
                
                xhr.onerror = function() {
                    alert('La demande a échoué');
                };
                

                var data = 'id=' + encodeURIComponent(id);
                xhr.send(data);
            } else {
                alert("Suppression de l'élément annulée.");
            }
        });
    });
});

</script>
{{ include('layouts/footer.php')}}