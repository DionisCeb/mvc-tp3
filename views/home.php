{{ include('layouts/header.php', {title:'Accueil'})}}
    <header>
        <div class="structure">
            <div class="header-section">
                <div class="header-section__box">
                    <div class="header-box__title">
                        <h1>Deluuxe Location</h1>
                    </div>
                    <div class="header-box__sub-title">
                        <h1>Nous offrons les meilleurs prix</h1>
                    </div>
                    <div class="header-box__buttons">
                        <a href="" class="header-box_btn deals-link">Voir les offres</a>
                        <a href="#reserve-sec" class="header-box_btn rent-link" id="reserver-sec-btn">Réservez maintenant</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="section__why-us flex-center-center">
        <div class="structure">
            <div class="container__why-us">
                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>2K</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Membres inscrits</h4>
                    </div>
                </div>

                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>15000+</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Inventaire vendu</h4>
                    </div>
                </div>

                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>100%</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Prix ​​de vente reçu</h4>
                    </div>
                </div>

                <div class="why-us__item">
                    <div class="why-us__item--title">
                        <h3>90%</h3>
                    </div>
                    <div class="why-us__item--subtitle">
                        <h4>Clients satisfaits</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="reservation-section" id="reserve-sec">
        <div class="structure">
            <div class="reservation-boxes-container">             
                    <div class="container__form-deals">
                        <div class="deals__create-booking">
                            <div class="create-booking__title">
                                <h1>Réservez maintenant</h1>
                            </div>
                            <div class="create-booking__subtitle">
                                <h3>Les meilleures réductions cette semaine</h3>
                            </div>
                            <div class="create-booking__link">
                                <a href="{{base}}/booking/create" class="header-box_btn deals-link">Réservez</a>
                            </div>
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

    

    <section class="section__newsletter flex-center-center">
        <div class="structure">
            <div class="newsletter__img-box--container">
                <div class="newsletter__subtitle--title--box">
                    <div class="newsletter__subtitle">
                        <small>Soyez plus proche</small>
                    </div>
                    <div class="newsletter__title">
                        <h1>Recevez les actualités en vous abonnant à notre infolettre</h1>
                    </div>
                    <form id="newsletterForm" method="post" action="{{base}}/newsletter/subscribe">
                        <div class="newsletter__box" style="display: flex; gap: 5px;">
                            <input type="email" name="email" class="newsletter__box--input" id="newsletter-email" placeholder="Enter your email..." required>
                            <button type="submit" class="btn btn-box newsletter-btn" id="newsletter-btn">Subscribe</button>
                        </div>
                    </form>

                </div>
                <div class="newsletter__img__box">
                    <img src="{{asset}}img/gallery/mercedes.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="location-section">
        <div class="structure">
            <div class="location-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22366.70793810311!2d-73.58369795659821!3d45.51332974876609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc91a4d31166b3d%3A0xe16252d7fe06209e!2zVmlsbGUtTWFyaWUsIE1vbnRyw6lhbCwgUXXDqWJlYw!5e0!3m2!1sro!2sca!4v1720417585497!5m2!1sro!2sca" width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
{{ include('layouts/footer.php')}}