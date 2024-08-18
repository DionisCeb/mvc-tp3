<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script type="module" src="assets/js/select-options.js" defer></script>
    <script src="assets/js/scrolling.js" defer></script>
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Deluxe Location</title>
</head>
<body>
    <nav>
        <div class="logo">
            <div class="logo-img"><img src="assets/img/nav/logo.jpg" alt="logo_img"></div>
            <h2>Deluxe Location</h2>
        </div>
        <div class="page-links">
            <a class="nav-btn" href="">À propos</a>
            <a class="nav-btn" href="">Catalogue</a>
            <a class="nav-btn" href="">Équipe</a>
            <a class="nav-btn" href="">Blog</a>
        </div>
        <div class="contact-us">
            <a class="contact-btn" href="">Contactez-nous</a>
        </div>
    </nav>
    <header>
        <div class="structure">
            <div class="header-section">
                <div class="header-section__box">
                    <div class="header-box__title">
                        <h1>Deluxe Location</h1>
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
    <main>
        <section class="reservation-section" id="reserve-sec">
            <div class="structure">
                <div class="reservation-boxes-container">             
                        <div class="container__form-deals">
                            <div class="form-box">
                            <form class="form-reservation" action="process_reservation.php" method="POST">
                                <select name="type" id="type">
                                    <option value="">Choisir le type</option>
                                    <option value="compact">Compacte</option>
                                    <option value="sport">Sport</option>
                                    <option value="suv">SUV</option>
                                    <option value="luxury">Voitures de luxe</option>
                                    <option value="sedan">Sedan</option>
                                </select>
                                <select name="make" id="make">
                                    <option value="">Choisir la marque</option>
                                    <option value="audi">Audi</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="toyota">Toyota</option>
                                    <option value="ford">Ford</option>
                                </select>
                                <select name="model" id="model">
                                    <option value="">Choisir le modèle</option>
                                    <option value="audi-a3" data-make="audi" data-type="compact">Audi A3</option>
                                    <option value="audi-a4" data-make="audi" data-type="sedan">Audi A4</option>
                                    <option value="audi-r8" data-make="audi" data-type="sport">Audi R8</option>
                                    <option value="mercedes-c-class" data-make="mercedes" data-type="sedan">Mercedes C-class</option>
                                    <option value="mercedes-a-class" data-make="mercedes" data-type="compact">Mercedes A-class</option>
                                    <option value="mercedes-s-class" data-make="mercedes" data-type="luxury">Mercedes S-class</option>
                                    <option value="mercedes-amg-gt" data-make="mercedes" data-type="sport">Mercedes AMG-GT</option>
                                    <option value="toyota-supra" data-make="toyota" data-type="sport">Toyota Supra</option>
                                    <option value="toyota-tacoma" data-make="toyota" data-type="suv">Toyota Tacoma</option>
                                    <option value="toyota-tundra" data-make="toyota" data-type="suv">Toyota Tundra</option>
                                    <option value="ford-f150" data-make="ford" data-type="suv">Ford F-150</option>
                                    <option value="ford-mustang" data-make="ford" data-type="sport">Ford Mustang</option>
                                </select>
                                <select name="color" id="color">
                                    <option value="">Choisir la couleur</option>
                                    <option value="white">Blanche</option>
                                    <option value="gray">Grise</option>
                                    <option value="black">Noire</option>
                                    <option value="blue">Bleue</option>
                                </select>
                                <div class="check-in">
                                    <input type="date" id="check-in-date" name="check-in-date">
                                    <input type="time" id="check-in-time" name="check-in-time">
                                </div>
                                <div class="check-out">
                                    <input type="date" id="check-out" name="check-out-date">
                                    <input type="time" id="check-out-time" name="check-out-time">
                                </div>
                                <div class="name-surname">
                                    <input type="text" name="nom" placeholder="Nom">
                                    <input type="text" name="prenom" placeholder="Prénom">
                                </div>
                                <div class="email-phone">
                                    <input type="email" name="email" placeholder="email@gmail.com">
                                    <input type="tel" name="telephone" placeholder="+1 439 678 9091">
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
                                    <img src="assets/img/gallery/mercedes.jpg" alt="mercedes-img">
                                </div>
                            </div>
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
    </main>
</body>
</html>