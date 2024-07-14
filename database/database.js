const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('./database/database.sqlite');

db.serialize(() => {
  // // Create users table with password field
  // db.run(`CREATE TABLE IF NOT EXISTS users (
  //   id INTEGER PRIMARY KEY AUTOINCREMENT,
  //   username TEXT,
  //   email TEXT UNIQUE,
  //   password TEXT,
  //   role TEXT DEFAULT 'user',
  //   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  //   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  // )`);

  // // Create blogs table
  // db.run(`CREATE TABLE IF NOT EXISTS blogs (
  //   id INTEGER PRIMARY KEY AUTOINCREMENT,
  //   title TEXT,
  //   content TEXT,
  //   likes_count INTEGER DEFAULT 0,
  //   comments_count INTEGER DEFAULT 0,
  //   status TEXT NOT NULL DEFAULT 'draft',
  //   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  //   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  // )`);

  // // Create likes table
  // db.run(`CREATE TABLE IF NOT EXISTS likes (
  //   id INTEGER PRIMARY KEY AUTOINCREMENT,
  //   blog_id INTEGER NOT NULL,
  //   user_id INTEGER NOT NULL,
  //   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  //   FOREIGN KEY (blog_id) REFERENCES blogs(id),
  //   FOREIGN KEY (user_id) REFERENCES users(id)
  // )`);

  // // Create comments table
  // db.run(`CREATE TABLE IF NOT EXISTS comments (
  //   id INTEGER PRIMARY KEY AUTOINCREMENT,
  //   blog_id INTEGER NOT NULL,
  //   user_id INTEGER NOT NULL,
  //   content TEXT NOT NULL,
  //   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  //   FOREIGN KEY (blog_id) REFERENCES blogs(id),
  //   FOREIGN KEY (user_id) REFERENCES users(id)
  // )`);

  // Check if admin exists
  db.get('SELECT * FROM users WHERE role = "admin"', (err, admin) => {
    if (err) {
      console.error('Error checking admin:', err.message);
    } else if (!admin) {
      // If no admin exists, insert default admin user
      const defaultAdmin = {
        username: 'admin',
        email: 'admin@example.com',
        password: 'admin', // You should hash this password before using it in production
        role: 'admin'
      };

      const bcrypt = require('bcrypt');
      bcrypt.hash(defaultAdmin.password, 10, (err, hashedPassword) => {
        if (err) {
          console.error('Error hashing password:', err.message);
        } else {
          db.run('INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)',
            [defaultAdmin.username, defaultAdmin.email, hashedPassword, defaultAdmin.role],
            (err) => {
              if (err) {
                console.error('Error inserting default admin:', err.message);
              } else {
                console.log('Default admin inserted successfully.');
              }
            });
        }
      });
    }
  });
});

module.exports = db;
