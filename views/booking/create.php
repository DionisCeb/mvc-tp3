{{ include('layouts/header.php', {title:'Créer une réservation'})}}
<section class="reservation-section" id="reserve-sec">
        <div class="structure">
            <div class="reservation-boxes-container">             
                    <div class="container__form-deals">
                        <div class="form-box">
                        <form class="form-reservation" action="" method="POST">
                            <div>
                                <select name="type" id="type">
                                    <option value="">Choisir le type</option>
                                    <option value="compact">Compacte</option>
                                    <option value="sport">Sport</option>
                                    <option value="suv">SUV</option>
                                    <option value="luxury">Voitures de luxe</option>
                                    <option value="sedan">Sedan</option>
                                </select>
                                {% if errors.type is defined %}
                                    <span class="error">{{ errors.type }}</span>
                                {% endif %}
                            </div>
                            <div>
                                <select name="make" id="make">
                                    <option value="">Choisir la marque</option>
                                    <option value="audi">Audi</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="toyota">Toyota</option>
                                </select>
                                {% if errors.make is defined %}
                                    <span class="error">{{ errors.make }}</span>
                                {% endif %}
                            </div>
                            <div>
                                <select name="model" id="model">
                                    <option value="">Choisir le modèle</option>
                                    <option value="audi A3" data-make="audi" data-type="compact">Audi A3</option>
                                    <option value="audi A4" data-make="audi" data-type="sedan">Audi A4</option>
                                    <option value="audi R8" data-make="audi" data-type="sport">Audi R8</option>
                                    <option value="audi Q8" data-make="audi" data-type="suv">Audi Q8</option>
                                    <option value="mercedes C-class" data-make="mercedes" data-type="sedan">Mercedes C-class</option>
                                    <option value="mercedes A-class" data-make="mercedes" data-type="compact">Mercedes A-class</option>
                                    <option value="mercedes G-class" data-make="mercedes" data-type="suv">Mercedes G-class</option>
                                    <option value="mercedes S-class" data-make="mercedes" data-type="luxury">Mercedes S-class</option>
                                    <option value="mercedes AMG-GT" data-make="mercedes" data-type="sport">Mercedes AMG-GT</option>
                                    <option value="toyota Supra" data-make="toyota" data-type="sport">Toyota Supra</option>
                                    <option value="toyota Camry" data-make="toyota" data-type="compact">Toyota Camry</option>
                                    <option value="toyota Corolla" data-make="toyota" data-type="sedan">Toyota Corolla</option>
                                    <option value="toyota Land Cruiser" data-make="toyota" data-type="luxury">Toyota Land Cruiser</option>
                                    <option value="toyota Tacoma" data-make="toyota" data-type="suv">Toyota Tacoma</option>
                                    <option value="toyota Tundra" data-make="toyota" data-type="suv">Toyota Tundra</option>
                                </select>
                                {% if errors.model is defined %}
                                    <span class="error">{{ errors.model }}</span>
                                {% endif %}
                            </div>
                            <div>
                                <select name="color" id="color">
                                    <option value="">Choisir la couleur</option>
                                    <option value="blanche">Blanche</option>
                                    <option value="gris">Grise</option>
                                    <option value="noire">Noire</option>
                                    <option value="bleue">Bleue</option>
                                </select>
                                {% if errors.color is defined %}
                                    <span class="error">{{ errors.color }}</span>
                                {% endif %}
                            </div>
                            <div>
                                <div class="check-in">
                                    <input type="date" id="check-in-date" name="check_in_date">
                                    <input type="time" id="check-in-time" name="check_in_time">
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
                                    <input type="date" id="check-out" name="check_out_date">
                                    <input type="time" id="check-out-time" name="check_out_time">
                                </div>
                                {% if errors.check_out_date is defined %}
                                    <span class="error">{{ errors.check_out_date }}</span>
                                {% endif %}

                                {% if errors.check_out_time is defined %}
                                    <span class="error">{{ errors.check_out_time }}</span>
                                {% endif %}
                            </div>
                            <div>
                                <div class="name-surname">
                                    <input type="text" name="name" placeholder="Nom">
                                    <input type="text" name="surname" placeholder="Prénom">
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
                                    <input type="email" name="email" placeholder="email@gmail.com">
                                    <input type="tel" name="phone" placeholder="1 439 678 9091">                                   
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
                                <input type="submit" name="submit" value="Réserver">
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