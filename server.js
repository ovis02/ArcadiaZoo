const express = require("express");
const mongoose = require("mongoose"); // Importer mongoose

const app = express();
const port = process.env.PORT || 3000; // Utilise le port fourni par Heroku

// URI de la base de données MongoDB
const uri = process.env.MONGODB_URI || "mongodb://127.0.0.1:27017/ArcadiaZoo";

// Connexion à MongoDB avec Mongoose
mongoose
  .connect(uri, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => {
    console.log("Connecté à MongoDB!");
  })
  .catch((err) => {
    console.error("Erreur de connexion à MongoDB:", err);
  });

// Middleware pour gérer les erreurs
app.use((req, res, next) => {
  res.setHeader("Access-Control-Allow-Origin", "*");
  res.setHeader(
    "Access-Control-Allow-Methods",
    "GET, POST, OPTIONS, PUT, PATCH, DELETE"
  );
  res.setHeader(
    "Access-Control-Allow-Headers",
    "X-Requested-With, content-type"
  );
  next();
});

// Modèle Mongoose pour les animaux
const animalSchema = new mongoose.Schema({
  animal: String,
  views: Number,
});

const Animal = mongoose.model("Animal", animalSchema);

// Route pour récupérer les animaux
app.get("/animals", async (req, res) => {
  try {
    const animals = await Animal.find(); // Récupérer tous les animaux
    res.status(200).json(animals); // Retourne les animaux en format JSON
  } catch (err) {
    console.error("Erreur lors de la récupération des animaux :", err);
    res.status(500).send("Erreur de récupération des animaux : " + err.message);
  }
});

// Démarre le serveur
app.listen(port, () => {
  console.log(`Le serveur est en écoute sur le port ${port}`);
});
