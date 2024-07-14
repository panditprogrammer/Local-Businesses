const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('./database/database.sqlite');

db.serialize(() => {

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
