<?php
include 'header.php';
?>
  <div class="background-section-desert">
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
        <h1 class="animals-title">Desert</h1>
        <p class="intro-animals">

Bienvenue dans notre zoo, une oasis de découverte au cœur de la nature sauvage. Explorez notre désert reconstitué, un monde de vastes enclos rocailleux et de ciels infinis. Ici, la vie prospère malgré les défis, avec des créatures extraordinaires adaptées à ce milieu unique. Rencontrez le majestueux cobra royal, le charmant fennec, la redoutable vipère du désert, le gracieux dromadaire et l'insaisissable iguane du désert, chacun illustrant une résilience remarquable dans ce paysage désolé mais magnifique.</p>
      </div>
    </div>
  </div>
<section class="section-services">
      <div class="service1">      
        <article class="description">
          <p>
  Prénom : Nick <br>
  Race : Vipère des sables <br>
         <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
         </p>
<div style="display: none">
  Habitat : Zones désertiques d'Afrique du Nord et du Moyen-Orient <br>
  État de l'animal : <br>
  Nourriture proposée : petits mammifères, oiseaux, lézards <br>
  Grammage de la nourriture : 100 grammes <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Nick" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
          <article class="service">
          <img
            src="desert/viperedesert.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
         </div>
         <hr class="service-divider">
         <div class="service2">
        <article class="service">
          <img
            src="desert/fenec.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
          <p>
  Prénom : Feunard <br>
  Race : Fennec <br>
         <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
          </p>
<div style="display: none">
  Habitat : Déserts d'Afrique du Nord <br>
  État de l'animal : <br>
  Nourriture proposée : petits rongeurs, insectes, fruits <br>
  Grammage de la nourriture : 50 à 100 grammes <br>
  Date de passage : 00/00/2024
  </div>
      <div class="like-button-container">
  <button id="increment-Feunard" class="jaime-btn">
    ❤️ J'aime
  </button>
   
          </div>
        </article>
      </div>
      <hr class="service-divider">
      <div class="service3">
       
        <article class="description">
        <p>
  Prénom : Abo <br>
  Race : Cobra royal <br>
             <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
             </p>
<div style="display: none">
  Habitat : Forêts tropicales, plaines et déserts d'Asie <br>
  État de l'animal : <br>
  Nourriture proposée : petits mammifères, oiseaux, reptiles <br>
  Grammage de la nourriture : 100 à 200 grammes <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Abo" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
         <article class="service">
          <img
            src="desert/cobraroyal.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
      <hr class="service-divider">
      <div class="service4">
        <article class="service">
          <img
            src="desert/dromadaire.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
      <p>
  Prénom : Doma <br>
  Race : Dromadaire <br>
               <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
               </p>
<div style="display: none">
  Habitat : Déserts d'Afrique du Nord et du Moyen-Orient <br>
  État de l'animal : <br>
  Nourriture proposée : herbes, feuilles, graines <br>
  Grammage de la nourriture : 5 à 10 kg <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Doma" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
      </div>
      <hr class="service-divider">
      <div class="service5">
      
        <article class="description">
          <p>
  Prénom : Zed <br>
  Race : Iguane du désert <br>
                 <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
                 </p>
<div style="display: none">
  Habitat : Déserts d'Amérique du Nord <br>
  État de l'animal : <br>
  Nourriture proposée : végétation désertique, insectes <br>
  Grammage de la nourriture : 50 à 100 grammes <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Zed" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
          <article class="service">
          <img
            src="desert/iguanedesert.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
</section>




    <?php include('footer.php'); ?>