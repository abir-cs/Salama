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

  // read JSON file
  const file = fs.readFileSync(filePath, "utf8");
  const reviews = JSON.parse(file);

  // push new review
  reviews.experiences.push(req.body);

  // write updated file
  fs.writeFileSync(filePath, JSON.stringify(reviews, null, 2));

  res.send({ success: true });
});

// Start server
app.listen(3000, () => {
  console.log("Server running at http://localhost:3000");
});
