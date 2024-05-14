<?php
include 'header.php';
?>
  <div class="background-section">
  <div class="container service-container">
    <div class="row">
      <nav class="col-md-3 service-nav"> 
        <ul>
          <li><a href="#ticket">Billeterie</a></li>
          <li><a href="#time">Accès & Horaires</a></li>
          <li><a href="#train">Petit Train</a></li>
          <li><a href="#guide">Guide</a></li>
          <li><a href="#restaurant">Restauration</a></li>
        </ul>
      </nav>
      <div class="col-md-9 content">
        <h1 class="service-title">Services</h1>
        <p class="intro">Découvrez une gamme de services conçus pour enrichir votre expérience et rendre votre visite aussi agréable que possible. Explorez notre billeterie pour obtenir vos billets d'entrée en toute simplicité, consultez notre plan d'accès et nos horaires pour planifier votre journée parfaite parmi les merveilles de la nature. Vous pouvez également choisir de profiter de notre petit train pour une visite panoramique confortable du parc, ou opter pour une visite guidée gratuite pour découvrir des faits fascinants sur nos habitants à fourrure et à plumes. Enfin, prenez une pause bien méritée et régalez-vous avec notre service de restauration proposant une variété de délices gastronomiques pour satisfaire toutes les papilles. Au Zoo, nous nous engageons à vous offrir une expérience inoubliable.</p>
      </div>
    </div>
  </div>
<section class="section-services">
      <div class="service1" id="ticket">      
        <article class="description">
          <h2 class="serv-title">Billetterie</h2>
          <p>
        Que vous veniez en famille, entre amis ou en solo, nous sommes prêts à vous accueillir pour une journée mémorable parmi les merveilles de la nature. Nos tarifs sont simples et accessibles à tous : l'entrée est gratuite pour les explorateurs de moins de 4 ans, 10 euros pour les enfants de 4 à 11 ans, et 15 euros pour les visiteurs de 11 ans et plus. Achetez vos billets directement sur place et préparez-vous à vivre des aventures inoubliables au zoo !
          </p>
        </article>
          <article class="service">
          <img
            src="services/billet.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
         </div>
         <hr class="service-divider">
         <div class="service2" id="time">
        <article class="service">
          <img
            src="services/zoo.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
          <h2 class="serv-title">Accès</h2>
          <p>
 Arcadia est idéalement situé près de la forêt de Brocéliande, en Bretagne. Pour nous rejoindre, vous pouvez utiliser plusieurs moyens de transport :
Voiture : Notre adresse pour GPS est la suivante Arcadia, Forêt de Brocéliande, 35XXX, Bretagne]. Des panneaux de signalisation vous guideront depuis les routes principales jusqu'à notre zoo.
Transport en commun : Vous pouvez également venir en transport en commun. Des lignes de bus desservent la zone à proximité du zoo.<br>
 
 <h2 class="serv-title">Horaires</h2>

 Nous sommes ouverts tous les jours de la semaine, sauf le lundi. 
Mardi au vendredi : 9h00 - 18h00
Samedi et dimanche : 10h00 - 19h00
          </p>
        </article>
      </div>
      <hr class="service-divider">
      <div class="service3" id="train">
       
        <article class="description">
          <h2 class="serv-title">Le petit train</h2>
          <p>
      
Préparez-vous à une visite panoramique relaxante à travers notre parc zooologique. Que vous soyez jeune ou jeune de cœur, notre petit train est prêt à vous emmener pour une aventure inoubliable. Montez à bord et laissez-vous 
guider à travers les merveilles de la nature, tout en profitant d'une vue imprenable sur nos habitats et nos habitants. Le voyage est inclus dans votre billet d'entrée, alors ne manquez pas cette occasion de découvrir le zoo d'une toute nouvelle perspective. Montez à bord du petit train pour une expérience unique
          </p>
        </article>
         <article class="service">
          <img
            src="services/minitrain.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
      <hr class="service-divider">
      <div class="service4" id="guide">
        <article class="service">
          <img
            src="services/guide.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
          <h2 class="serv-title">Guide</h2>
          <p>
            

Profitez de l'opportunité de découvrir notre zoo aux côtés de nos guides expérimentés et passionnés. Nos visites guidées sont un excellent moyen d'en apprendre davantage sur nos habitants à fourrure et à plumes, ainsi que sur les efforts de conservation que nous menons. Que vous soyez intéressé par les faits fascinants sur nos animaux, les anecdotes sur leur comportement ou les défis auxquels ils sont confrontés dans la nature, nos guides sont là pour répondre à toutes vos questions et rendre votre visite encore plus enrichissante.
 Rejoignez-nous pour une expérience immersive et éducative lors de nos visites guidées gratuites.
          </p>
        </article>
      </div>
      <hr class="service-divider">
      <div class="service5" id="restaurant">
      
        <article class="description">
          <h2 class="serv-title">Restauration</h2>
          <p>
            Détendez-vous et régalez-vous avec notre sélection savoureuse de burgers, paninis et bien plus encore. Notre restaurant vous propose une expérience 
culinaire exceptionnelle, où chaque plat est préparé avec soin et fraîcheur. Que vous soyez amateur de viande juteuse, de fromage fondant ou de légumes croquants, nous avons quelque chose pour satisfaire toutes les papilles. 
Avec une ambiance conviviale et une vue imprenable sur notre zoo, Arcadia Food est l'endroit idéal pour une pause bien méritée lors de votre visite.
          </p>
        </article>
          <article class="service">
          <img
            src="services/restaurant.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
</section>




    <?php include('footer.php'); ?>