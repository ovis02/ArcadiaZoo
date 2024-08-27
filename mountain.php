<?php
include 'header.php';
?>
  <div class="background-section-mountain">
  <div class="container service-container">
    <div class="row">
      <nav class="col-md-3 service-nav"> 
        <ul>
               <li <?php if(basename($_SERVER['PHP_SELF']) == 'desert.php') echo 'class="active"'; ?>><a href="desert.php">Desert</a></li>
      <li <?php if(basename($_SERVER['PHP_SELF']) == 'jungle.php') echo 'class="active"'; ?>><a href="jungle.php">Jungle</a></li>
     <li <?php if(basename($_SERVER['PHP_SELF']) == 'mountain.php') echo 'class="active"'; ?>><a href="mountain.php">Montagne</a></li>
               <li <?php if(basename($_SERVER['PHP_SELF']) == 'marais.php') echo 'class="active"'; ?>><a href="marais.php">Marais</a></li>
         <li <?php if(basename($_SERVER['PHP_SELF']) == 'savane.php') echo 'class="active"'; ?>><a href="savane.php">Savane</a></li>
        </ul>
      </nav>
      <div class="col-md-9 content animals-intro">
        <h1 class="animals-title">Montagne</h1>
        <p class="intro-animals">


  Bienvenue dans les Montagnes, un monde d'altitude et de majesté au cœur même de notre zoo. Découvrez l'aigle royal, le bouquetin, le chamois, le loup et la marmotte, chacun parfaitement adapté à ce royaume de sommets enneigés et de vallées verdoyantes.<br>
  <br>
  Plongez dans cet habitat alpin où chaque pic et chaque vallée révèle la beauté et la résilience de la vie sauvage des Montagnes.
</p>


      </div>
    </div>
  </div>
<section class="section-services">
      <div class="service1">      
        <article class="description">
<p>
  Prénom : Scott <br>
  Race : Aigle royal <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
          </p>
<div style="display: none">
  Habitat : Régions montagneuses et falaises escarpées <br>
  État de l'animal : <br>
  Nourriture proposée : petits mammifères, oiseaux, reptiles <br>
  Grammage de la nourriture : 500 à 1000 grammes <br>
  Date de passage : 00/00/2024

</div>
<div class="like-button-container">
  <button id="increment-Scott" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
          <article class="service">
          <img
            src="montagne/aigleroyal.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
         </div>
         <hr class="service-divider">
         <div class="service2">
        <article class="service">
          <img
            src="montagne/bouquetin.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
         <p>
  Prénom : Cricri <br>
  Race : Bouquetin <br>
    <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
    </p>
<div style="display: none">
  Habitat : Montagnes rocailleuses et pentes escarpées <br>
  État de l'animal : <br>
  Nourriture proposée : herbes alpines, lichens, petits arbustes <br>
  Grammage de la nourriture : 2 à 4 kg <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-CriCri" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
      </div>
      <hr class="service-divider">
      <div class="service3">
       
        <article class="description">
    <p>
  Prénom : Doug <br>
  Race : Chamois <br>
      <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
<div style="display: none">
  </p>
  Habitat : Montagnes rocailleuses et pentes escarpées <br>
  État de l'animal : <br>
  Nourriture proposée : herbes alpines, lichens, petits arbustes <br>
  Grammage de la nourriture : 2 à 4 kg <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Doug" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
         <article class="service">
          <img
            src="montagne/chamois.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
      <hr class="service-divider">
      <div class="service4 " id="loup">
        <article class="service">
          <img
            src="montagne/loup.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
    <p>
  Prénom : Wolf <br>
  Race : Loup gris <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
<div style="display: none">
  Habitat : Forêts et montagnes boisées <br>
  État de l'animal : <br>
  Nourriture proposée : viande de bœuf, poulet, poisson <br>
  Grammage de la nourriture : 2 à 3 kg <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Wolf" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>


        </article>
      </div>
      <hr class="service-divider">
      <div class="service5">
      
        <article class="description">
      <p>
  Prénom : Spog <br>
  Race : Marmotte <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
          </p>
<div style="display: none">
  Habitat : Montagnes rocheuses et prairies alpines <br>
  État de l'animal : <br>
  Nourriture proposée : herbes, racines, baies <br>
  Grammage de la nourriture : 200 à 400 grammes <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Spog" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>

        </article>
          <article class="service">
          <img
            src="montagne/marmotte.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
</section>




    <?php include('footer.php'); ?>