const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('./database/database.sqlite');

db.serialize(() => {
  // Create blogs table
  db.run(`CREATE TABLE IF NOT EXISTS blogs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    content TEXT,
    likes_count INTEGER DEFAULT 0,  
    status TEXT NOT NULL DEFAULT 'draft'
  )`);


  // Create comments table
  db.run(`CREATE TABLE IF NOT EXISTS comments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    blog_id INTEGER NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (blog_id) REFERENCES blogs(id)
  )`);
});

module.exports = db;
