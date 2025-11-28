import express from "express";
import fs from "fs";
import path from "path";
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
app.use(express.json());

// Serve your site
app.use(express.static(__dirname));

// Route to add review
app.post("/add-review", (req, res) => {
  const filePath = path.join(__dirname, "docs", "experiences.json");

  const file = fs.readFileSync(filePath, "utf8");
  const reviews = JSON.parse(file);

  reviews.experiences.push(req.body);

  fs.writeFileSync(filePath, JSON.stringify(reviews, null, 2));

  res.send({ success: true });
});

// route to add appointment
app.post("/add-appointment", (req, res) => {
  const filePath = path.join(__dirname, "docs", "appointments.json");

  const file = fs.readFileSync(filePath, "utf8");
  const data = JSON.parse(file);

  data.appointments.push(req.body);

  fs.writeFileSync(filePath, JSON.stringify(data, null, 2));

  res.send({ success: true });
});

// Start server
app.listen(3000, () => {
  console.log("Server running at http://localhost:3000");
});
