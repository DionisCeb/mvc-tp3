{{ include('layouts/header.php', {title:'Booking'})}}

<section class="form-section">
        <div class="structure">
            <div class="form-box form-box-center">
                <div class="form-title">
                    <h1>Modifier la réservation numéro {{booking.booking_id}} de {{booking.client_name}} {{booking.client_surname}}</h1>
                </div>
                <form class="form-reservation" method="post" action="">
                    <div>
                        <select name="type" id="cars">
                            <option value="">Choisir le type</option>
                            <option value="compact" {% if booking.car_type == 'compact' %}selected{% endif %}>Compacte</option>
                            <option value="sport" {% if booking.car_type == 'sport' %}selected{% endif %}>Sport</option>
                            <option value="suv" {% if booking.car_type == 'suv' %}selected{% endif %}>SUV</option>
                            <option value="luxury" {% if booking.car_type == 'luxury' %}selected{% endif %}>Voitures de luxe</option>
                            <option value="sedan" {% if booking.car_type == 'sedan' %}selected{% endif %}>Sedan</option>
                        </select>
                        {% if errors.type is defined %}
                            <span class="error">{{ errors.type }}</span>
                        {% endif %}
                    </div>

                    <div>
                        <select name="make" id="make">
                            <option value="">Choisir la marque</option>
                            <option value="audi" {% if booking.car_make == 'audi' %}selected{% endif %}>Audi</option>
                            <option value="mercedes" {% if booking.car_make == 'mercedes' %}selected{% endif %}>Mercedes</option>
                            <option value="toyota" {% if booking.car_make == 'toyota' %}selected{% endif %}>Toyota</option>
                        </select>
                        {% if errors.make is defined %}
                            <span class="error">{{ errors.make }}</span>
                        {% endif %}
                    </div>


                    <div>
                        <select name="model" id="model">
                            <option value="">Choisir le modèle</option>
                            <option value="audi A3" {% if booking.car_model == 'audi A3' %}selected{% endif %}>A3</option>
                            <option value="audi A4" {% if booking.car_model == 'audi A4' %}selected{% endif %}>A4</option>
                            <option value="audi R8" {% if booking.car_model == 'audi R8' %}selected{% endif %}>R8</option>
                            <option value="audi Q8" {% if booking.car_model == 'audi Q8' %}selected{% endif %}>R8</option>
                            <option value="mercedes C-class" {% if booking.car_model == 'mercedes C-class' %}selected{% endif %}>C-class</option>
                            <option value="mercedes A-class" {% if booking.car_model == 'mercedes A-class' %}selected{% endif %}>A-class</option>
                            <option value="mercedes G-class" {% if booking.car_model == 'mercedes G-class' %}selected{% endif %}>G-class</option>
                            <option value="mercedes S-class" {% if booking.car_model == 'mercedes S-class' %}selected{% endif %}>S-class</option>
                            <option value="mercedes AMG-GT" {% if booking.car_model == 'mercedes AMG-GT' %}selected{% endif %}>AMG-GT-class</option>
                            <option value="toyota Supra" {% if booking.car_model == 'toyota Supra' %}selected{% endif %}>Supra</option>
                            <option value="toyota Camry" {% if booking.car_model == 'toyota Camry' %}selected{% endif %}>Camry</option>
                            <option value="toyota Corolla" {% if booking.car_model == 'toyota Corolla' %}selected{% endif %}>Corolla</option>
                            <option value="toyota Land Cruiser" {% if booking.car_model == 'toyota Camry' %}selected{% endif %}>Land Cruiser</option>
                            <option value="toyota Tacoma" {% if booking.car_model == 'toyota Tacoma' %}selected{% endif %}>Tacoma</option>
                            <option value="toyota Tundra" {% if booking.car_model == 'toyota Tundra' %}selected{% endif %}>Tundra</option>
                        </select>
                        {% if errors.model is defined %}
                            <span class="error">{{ errors.model }}</span>
                        {% endif %}
                    </div>

                    <div>
                        <select name="color" id="color" class="{% if errors.color is defined %}error{% endif %}">
                            <option value="">Choisir la couleur</option>
                            <option value="blanche" {% if booking.car_color == 'blanche' %}selected{% endif %}>Blanche</option>
                            <option value="gris" {% if booking.car_color == 'gris' %}selected{% endif %}>Grise</option>
                            <option value="noire" {% if booking.car_color == 'noire' %}selected{% endif %}>Noire</option>
                            <option value="bleue" {% if booking.car_color == 'bleue' %}selected{% endif %}>Bleue</option>
                        </select>
                        {% if errors.color is defined %}
                            <span class="error">{{ errors.color }}</span>
                        {% endif %}
                    </div>
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
                        <button type="submit" name="update" class="header-box_btn deals-link return-primary-btn">Sauvegarder</button>
                        <a href="{{base}}/bookings" class="header-box_btn deals-link return-secondary-btn">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

{{ include('layouts/footer.php')}}