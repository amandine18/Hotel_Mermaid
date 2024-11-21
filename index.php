<?php

require_once (__DIR__ . '/config/database.php');
require_once (__DIR__ . '/includes/cookies.php');
require_once (__DIR__ . '/includes/header.php');
require_once (__DIR__ . '/includes/head.php');

$template = new Template();

?>

        <?php echo $template::getHead('Accueil'); ?>
        <main role="main">
            <div class="section">
                <img src="uploads/fond_piscine.jpg" alt="image piscine">
                <h1>Hôtel Mermaid</h1>
                <h4><i class="fa-solid fa-star" style="color: rgb(100, 149, 237);"></i><i class="fa-solid fa-star" style="color: rgb(100, 149, 237);"></i><i class="fa-solid fa-star" style="color: rgb(100, 149, 237);"></i><a class="lieu"> Palavas </a><i class="fa-solid fa-star" style="color: rgb(100, 149, 237);"></i><i class="fa-solid fa-star" style="color: rgb(100, 149, 237);"></i><i class="fa-solid fa-star" style="color: rgb(100, 149, 237);"></i></h4>
            </div>
            <div class="container">
                <div class="text1">
                    <a>Un cadre idyllique au bord de la mer</a>
                    <p>
                        Depuis 1995, votre Hôtel 3 Étoiles allie charme, confort, calme et modernité. Situé à 500 mètres de la plage de Palavas Les Flots, 
                        <br> l’Hôtel Mermaid vous permet de savourer le charme Méditerranéen de la ville, sa gastronomie et ses plages toujours animées.
                    </p>
                </div>
                <div class="section2">
                    <img src="uploads/chambre1balconvuemer.png" alt="image chambre">
                    <div class="image">
                        <a>Spacieuses et confortables</a>
                        <p>
                            Séjournez dans nos chambres modernes au design contemporain afin de passer un moment de calme et de repos. 
                            Choisissez votre catégorie selon vos préférences et optez pour une belle vue sur la mer.
                        </p>
                        <a href="src/bedroom/index.php" class="click">Découvrez nos chambres</a>
                    </div>
                </div>
                <div class="text2">
                    <a>Des équipements sur mesure</a>
                    <p>
                        Bénéficiez d'un confort et de services sur mesure grâce à nos nombreux équipements disponibles. 
                        Pour que tous nos visiteurs se sentent chez eux, <br> nous offrons également des chambres avec un accès PMR 
                        (uniquement sur les supérieures Rez de chaussée).
                    </p>
                </div>
                <div class="equipements1">
                    <ul>
                        <li><i class="fa-light fa-id-card-clip fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Clés d'accès</li>
                        <li><i class="fa-light fa-water-ladder fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Piscine extérieure</li>
                        <li><i class="fa-light fa-utensils fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Restaurant</li>
                        <li><i class="fa-light fa-couch fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Espace détente commun</li>                    
                    </ul>
                </div>
                <div class="equipements2">
                    <ul class="bottom">
                        <li><i class="fa-light fa-elevator fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Ascenseur</li>
                        <li><i class="fa-light fa-wifi fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Wifi gratuit</li>
                        <li><i class="fa-light fa-temperature-arrow-down fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Climatisation</li>
                        <li><i class="fa-light fa-tv fa-2xl" style="color: rgb(100, 149, 237);"></i><br><br>Télévision</li>
                    </ul>
                </div>  
            </div>
        </main>

<?php require_once (__DIR__ . '/includes/footer.php'); ?>