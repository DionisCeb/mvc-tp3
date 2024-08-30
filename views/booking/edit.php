{{ include('layouts/header.php', {title:'Booking'})}}

<section class="form-section">
        <div class="structure">
            <div class="form-box form-box-center">
                <div class="form-title">
                    <h1>Modifier la réservation numéro {{booking.booking_id}} de {{booking.client_name}} {{booking.client_surname}}</h1>
                </div>
                <form class="form-reservation" method="post" action="">
                    {% if session.privilege_id == 1 or session.privilege_id == 2 %}
                    <div>
                        <div class="check-in">
                            <input type="date" id="check-in-date" name="check_in_date" value="{{booking.check_in_date}}" required>
                            <input type="time" id="check-in-time" name="check_in_time" value="{{booking.check_in_time}}" required>
                        </div>
                        {% if errors.check_in_date is defined %}
                            <span class="error">{{ errors.check_in_date }}</span>
                        {% endif %}
                        {% if errors.check_in_time is defined %}
                            <span class="error">{{ errors.check_in_time }}</span>
                        {% endif %}
                    </div>

                    <div>
                        <div class="check-out">
                            <input type="date" id="check-out-date" name="check_out_date" value="{{booking.check_out_date}}" required>
                            <input type="time" id="check-out-time" name="check_out_time" value="{{booking.check_out_time}}" required>
                        </div>
                        {% if errors.check_out_date is defined %}
                            <span class="error">{{ errors.check_out_date }}</span>
                        {% endif %}
                        {% if errors.check_out_time is defined %}
                            <span class="error">{{ errors.check_out_time }}</span>
                        {% endif %}
                    </div>

                    <div>
                        <select name="type" id="type">
                            <option value="">Choisir le type</option>
                            {% for type in types %}
                                <option value="{{ type }}" {% if booking.car_type == type %}selected{% endif %}>{{ type }}</option>
                            {% endfor %}
                        </select>
                        {% if errors.type is defined %}
                            <span class="error">{{ errors.type }}</span>
                        {% endif %}
                    </div>

                    <div>
                        <select name="make" id="make">
                           {% for make in makes %}
                                <option value="{{ make }}" {% if booking.car_make == make %}selected{% endif %}>{{ make }}</option>
                            {% endfor %}
                        </select>
                        {% if errors.make is defined %}
                            <span class="error">{{ errors.make }}</span>
                        {% endif %}
                    </div>


                    <div>
                        <select name="model" id="model">
                            <option value="">Choisir le modèle</option>
                            {% for model in models %}
                                <option value="{{ model }}" {% if booking.car_model == model %}selected{% endif %}>{{ model }}</option>
                            {% endfor %}
                        </select>
                        {% if errors.model is defined %}
                            <span class="error">{{ errors.model }}</span>
                        {% endif %}
                    </div>

                    <div>
                        <select name="color" id="color" class="{% if errors.color is defined %}error{% endif %}">
                            <option value="">Choisir la couleur</option>
                            {% for color in colors %}
                                <option value="{{ color }}" {% if booking.car_color == color %}selected{% endif %}>{{ color }}</option>
                            {% endfor %}
                        </select>
                        {% if errors.color is defined %}
                            <span class="error">{{ errors.color }}</span>
                        {% endif %}
                    </div>
                    {% endif %}
                    
                    
                    <div class="name-surname">
                        <input type="text" name="name" placeholder="Nom" value="{{booking.client_name}}" required>
                        {% if errors.name is defined %}
                            <span class="error">{{ errors.name }}</span>
                        {% endif %}
                        <input type="text" name="surname" placeholder="Prénom" value="{{booking.client_surname}}" required>
                        {% if errors.surname is defined %}
                            <span class="error">{{ errors.surname }}</span>
                        {% endif %}
                    </div>
                    <div class="email-phone">
                        <input type="email" name="email" placeholder="email@gmail.com" value="{{booking.client_email}}" required>
                        {% if errors.email is defined %}
                            <span class="error">{{ errors.email }}</span>
                        {% endif %}
                        <input type="tel" name="phone" placeholder="+1 439 678 9091" value="{{booking.client_phone}}" required>
                        {% if errors.phone is defined %}
                            <span class="error">{{ errors.phone }}</span>
                        {% endif %}
                    </div>
                    <div class="reserve-submit">
                        <button type="submit" name="update" class="btn btn-box details">Sauvegarder</button>
                        {% if session.privilege_id != 1 and session.privilege_id != 2 %}
                        <a href="{{base}}/booking/show?id={{booking.booking_id}}" class="btn btn-box details">Annuler</a>
                        {% endif %}

                        {% if session.privilege_id == 1 or session.privilege_id == 2 or session.privilege_id == 3 %} 
                            <a href="{{base}}/bookings" class="btn btn-box details">Annuler</a>
                        {% endif %}
                    </div>
                </form>
                {% if session.privilege_id != 1 and session.privilege_id != 2 %}
                <div class="form-edit-question">
                    <h3>For other modifications, please call the suport team</h3>
                    <a href="{{base}}/bookings" class="btn btn-box details">Contactez-nous</a>
                </div>
                {% endif %}
                
            </div>
        </div>
    </section>

{{ include('layouts/footer.php')}}