const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

// Crée l'application Express
const app = express();

// Définit le port de manière dynamique pour Heroku ou 4000 en local
const port = process.env.PORT || 4000;

// Middleware
app.use(cors());
app.use(express.json());

// Connexion à MongoDB Atlas
const mongoURI =
  process.env.MONGODB_URI ||
  "mongodb+srv://oves7860:Mohammad786.@arcadiazoo.mongodb.net/ArcadiaZoo?retryWrites=true&w=majority";
mongoose
  .connect(mongoURI, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => {
    console.log("Connexion à MongoDB Atlas réussie");
  })
  .catch((err) => {
    console.error("Erreur de connexion à MongoDB Atlas :", err.message);
  });

// Schéma et modèle MongoDB pour les vues d'animaux
const animalViewSchema = new mongoose.Schema({
  animal: { type: String, required: true },
  views: { type: Number, default: 0 },
});

const AnimalView = mongoose.model(
  "AnimalView",
  animalViewSchema,
  "animalviews"
);

// Route pour incrémenter le compteur de vues pour un animal spécifique
app.post("/animal/:name/click", async (req, res) => {
  try {
    const animalName = req.params.name;
    let animal = await AnimalView.findOne({ animal: animalName });

    if (animal) {
      animal.views += 1;
      await animal.save();
      res
        .status(200)
        .json({ message: "Compteur incrémenté avec succès", animal });
    } else {
      animal = new AnimalView({ animal: animalName, views: 1 });
      await animal.save();
      res.status(201).json({ message: "Animal ajouté avec succès", animal });
    }
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Route pour récupérer tous les animaux et leurs compteurs de vues
app.get("/animals", async (req, res) => {
  try {
    const animals = await AnimalView.find({});
    res.status(200).json(animals);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Route par défaut pour la racine
app.get("/", (req, res) => {
  res.send(
    "Bienvenue sur le serveur ArcadiaZoo API. Utilisez les routes spécifiques pour interagir."
  );
});

// Démarre le serveur
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
