const express = require('express');
const bodyParser = require('body-parser');
const methodOverride = require('method-override');
const session = require('express-session');
const dbAdmin = require('./database/database'); // Ensure this is required to initialize the admin details only
const app = express();
const port = 3000;

// for db --------------------
const fs = require('fs');
const sqlite3 = require('sqlite3').verbose();

const dbPath = './database/database.sqlite'; // Adjust this to your SQLite database file path
const db = new sqlite3.Database(dbPath);

// Read and execute the schema file
const schemaPath = './db-schema.sql';
const schema = fs.readFileSync(schemaPath, 'utf8');

// Execute SQL commands in the schema file
db.serialize(() => {
  db.exec(schema, err => {
    if (err) {
      console.error('Error executing schema:', err);
    } else {
      console.log('Database schema initialized successfully');
      // Start your Express server or perform other actions here
    }
  });
});

// Close the database connection after executing schema
db.close();
// --------------------



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
    dbAdmin.serialize(() => {
      dbAdmin.get("SELECT * FROM users", (err, data) => {
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
