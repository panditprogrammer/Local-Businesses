const express = require('express');
const bodyParser = require('body-parser');
const methodOverride = require('method-override');
const session = require('express-session');
const db = require('./database/database'); // Ensure this is required to initialize the admin details only
const app = express();
const flash = require('connect-flash');


const port = 3000;

  // Set up view engine
  app.set('view engine', 'ejs');

// Middleware
app.use(express.static('public'));
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.json());
app.use(methodOverride('_method'));

app.use(session({
  secret: 'your_secret_key',
  resave: false,
  saveUninitialized: true
}));

app.use(flash());
app.use((req, res, next) => {
  res.locals.errorMessage = req.flash('errorMessage');
  next();
});

// Import routes
const blogRouter = require('./routes/blog');
const adminRouter = require('./routes/admin');
const userRouter = require('./routes/user');

// Use routes
app.use('/', blogRouter);
app.use('/admin', adminRouter);
app.use('/user', userRouter);

// Async function to initialize database and start server
async function initializeAndStartServer() {
  // Ensure the database is initialized
  await new Promise((resolve, reject) => {
    db.serialize(() => {
      db.get("SELECT * FROM users", (err, data) => {
        if (err) {
          console.error("Error fetching users:", err.message);
          return reject(err);
        }
        console.log("database connected");
        resolve();
      });
    });
  });

  // Start the server
  app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
  });
}

// Initialize the database and start the server
initializeAndStartServer().catch(err => {
  console.error("Failed to initialize database and start server:", err.message);
});
