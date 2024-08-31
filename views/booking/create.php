{{ include('layouts/header.php', {title:'Créer une réservation'})}}
<section class="reservation-section" id="reserve-sec">
        <div class="structure">
            <div class="reservation-boxes-container">             
                    <div class="container__form-deals">
                        <div class="form-box">
                        <form class="form-reservation" action="{{ base }}/booking/create" method="POST">
                            <div>
                                <div class="check-in">
                                    <input type="date" id="check-in-date" name="check_in_date" value="{{ booking.check_in_date | default('') }}">
                                    <input type="time" id="check-in-time" name="check_in_time" value="{{ booking.check_in_time | default('') }}">
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
                                    <input type="date" id="check-out-date" name="check_out_date" value="{{ booking.check_out_date | default('') }}">
                                    <input type="time" id="check-out-time" name="check_out_time" value="{{ booking.check_out_time | default('') }}">
                                </div>
                                {% if errors.check_out_date is defined %}
                                    <span class="error">{{ errors.check_out_date }}</span>
                                {% endif %}

                                {% if errors.check_out_time is defined %}
                                    <span class="error">{{ errors.check_out_time }}</span>
                                {% endif %}
                            </div>
                             <!-- Car Type -->
                            <div>
                                <select name="type" id="type">
                                    <option value="">Choisir le type</option>
                                    {% for car in cars %}
                                        <option value="{{ car.type }}" {% if booking.car_type == car.type %}selected{% endif %}>{{ car.type }}</option>
                                    {% endfor %}
                                </select>
                                {% if errors.type is defined %}
                                    <span class="error">{{ errors.type }}</span>
                                {% endif %}
                            </div>

                            <!-- Car Make -->
                            <div>
                                <select name="make" id="make">
                                    <option value="">Choisir la marque</option>
                                    {% for car in cars %}
                                        <option value="{{ car.make }}" data-type="{{ car.type }}" {% if booking.car_make == car.make %}selected{% endif %}>{{ car.make }}</option>
                                    {% endfor %}
                                </select>
                                {% if errors.make is defined %}
                                    <span class="error">{{ errors.make }}</span>
                                {% endif %}
                            </div>

                            <!-- Car Model -->
                            <div>
                                <select name="model" id="model">
                                    <option value="">Choisir le modèle</option>
                                    {% for car in cars %}
                                        <option value="{{ car.model }}" data-make="{{ car.make }}" data-type="{{ car.type }}" {% if booking.car_model == car.model %}selected{% endif %}>{{ car.model }}</option>
                                    {% endfor %}
                                </select>
                                {% if errors.model is defined %}
                                    <span class="error">{{ errors.model }}</span>
                                {% endif %}
                            </div>

                            <!-- Car Color -->
                            <div>
                                <select name="color" id="color">
                                    <option value="">Choisir la couleur</option>
                                    {% for car in cars %}
                                        <option value="{{ car.color }}" data-model="{{ car.model }}" data-make="{{ car.make }}" data-type="{{ car.type }}" {% if booking.car_color == car.color %}selected{% endif %}>{{ car.color }}</option>
                                    {% endfor %}
                                </select>
                                {% if errors.color is defined %}
                                    <span class="error">{{ errors.color }}</span>
                                {% endif %}
                            </div>
                            
                            <div>
                                <div class="name-surname">
                                    <input type="text" name="name" placeholder="Nom" id="name" value="{{ booking.name | default('') }}">
                                    <input type="text" name="surname" placeholder="Prénom" id="surname" value="{{ booking.surname | default('') }}">
                                </div>
                                {% if errors.name is defined %}
                                    <span class="error">{{ errors.name }}</span>
                                {% endif %}

                                {% if errors.surname is defined %}
                                    <span class="error">{{ errors.surname }}</span>
                                {% endif %}
                            </div>
                            <div>
                                <div class="email-phone">
                                    <input type="email" name="email" placeholder="email@gmail.com" id="email" value="{{ booking.email | default('') }}">
                                    <input type="tel" name="phone" placeholder="1 439 678 9091" id="phone" value="{{ booking.phone | default('') }}">                                   
                                </div>
                                    <div class="error-div">
                                        {% if errors.email is defined %}
                                            <span class="error">{{ errors.email }}</span>
                                        {% endif %}
                                        {% if errors.phone is defined %}
                                            <span class="error">{{ errors.phone }}</span>
                                        {% endif %}
                                    </div>
                            </div>
                            <div class="reserve-submit">
                                <input type="submit" name="submit" value="Réserver" id="submit-button">
                            </div>
                        </form>

                        </div>
                        <div class="deals-box">
                            <h1 class="deals-title">
                                OBTENEZ 15% DE RABAIS SUR VOTRE LOCATION
                            </h1>
                            <div class="deals-img">
                                <img src="{{asset}}img/gallery/mercedes.jpg" alt="mercedes-img">                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{ include('layouts/footer.php')}}