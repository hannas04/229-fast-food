const express = require('express');
const path = require('path');

const app = express();
const port = 3000;

app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(path.join(__dirname)));

app.post('/send-email', (req, res) => {
  const { name, email, message } = req.body;
  console.log('Form data:', { name, email, message });
  res.send('Thanks! Your message was received.');
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});