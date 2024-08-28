const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const app = express();
const port = 3000;

// Middleware
app.use(cors());
app.use(express.json());

// Connexion à MongoDB sans les options dépréciées
mongoose.connect("mongodb://localhost:27017/ArcadiaZoo");

// Schéma et modèle MongoDB
const animalViewSchema = new mongoose.Schema({
  animal: { type: String, required: true },
  views: { type: Number, default: 0 },
});

const AnimalView = mongoose.model(
  "AnimalView",
  animalViewSchema,
  "animalviews"
);

// Route pour incrémenter le compteur de vues pour Godzilla
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

app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
