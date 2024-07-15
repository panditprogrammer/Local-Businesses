const express = require('express');
const router = express.Router();
const db = require('../database/database');
const bcrypt = require('bcrypt');

// Render registration page
router.get('/register', (req, res) => {
  const loggedIn = req.session.userId ? true : false;
  if (req.session.userId) {
    res.redirect('/');
  }
  res.render('user/register', { loggedIn });
});


// Handle user registration
router.post('/register', async (req, res) => {
  try {
    const { username, email, password } = req.body;

    if (!username.trim()) {
      return res.json({ success: false, message: 'Please enter username' });
    }

    if (!email.trim()) {
      return res.json({ success: false, message: 'Please enter email' });
    }

    if (!password.trim()) {
      return res.json({ success: false, message: 'Please enter password' });
    }

    // Check if user with the same email already exists
    db.get('SELECT * FROM users WHERE email = ?', [email], async (err, existingUser) => {
      if (err) {
        return res.json({ success: false, message: 'Error checking existing user' });
      }
      if (existingUser) {
        // User with this email already exists
        return res.json({ success: false, message: 'Email already registered' });
      }

      // If email is not already registered, proceed with registration
      const hashedPassword = await bcrypt.hash(password, 10);
      db.run('INSERT INTO users (username, email, password) VALUES (?, ?, ?)', [username, email, hashedPassword], function (err) {
        if (err) {
          return res.json({ success: false, message: 'Error registering user' });
        }
        res.json({ success: true });
      });
    });
  } catch (err) {
    res.json({ success: false, message: 'Error during registration' });
  }
});



// Render login page
router.get('/login', (req, res) => {
  const loggedIn = req.session.userId ? true : false;
  if (req.session.userId) {
    res.redirect('/');
  }
  res.render('user/login', { loggedIn });
});

// Handle user login
router.post('/login', (req, res) => {
  const { email, password } = req.body;


  db.get('SELECT * FROM users WHERE email = ?', [email], async (err, user) => {
    if (err) {
      return res.json({ success: false, message: 'Error logging in' });
    }

    if (!user || !(await bcrypt.compare(password, user.password))) {
      return res.json({ success: false, message: 'Invalid email or password' });
    }

    req.session.userId = user.id;
    res.json({ success: true });
  });
});


// user setting
router.get('/settings', (req, res) => {
  const loggedIn = req.session.userId ? true : false;
  const id = req.session.userId;

  db.get('SELECT * FROM users WHERE id = ?', [id], (err, user) => {
    if (err) throw err;
    res.render('user/settings', { user, loggedIn });
  });
});



// user setting
router.post('/settings', (req, res) => {

  const id = req.session.userId;
  const { username, email } = req.body;



  if (username.trim() == "") {
    req.flash('errorMessage', 'please fill the username field!');
    return res.redirect('/user/settins');
  }

  if (email.trim() == "") {
    req.flash('errorMessage', 'please fill the email field!');
    return res.redirect('/user/settins');
  }

  // Check if user exists
  db.get('SELECT * FROM users WHERE id = ?', [id], (err, user) => {
    if (err) {
      return res.status(500).send('Error fetching user');
    }

    if (!user) {
      res.status(500).send('Error creating user');
    } else {
      // If user exists, update user settings
      db.run('UPDATE users SET username = ?, email = ? WHERE id = ?', [username, email, id], (err) => {
        if (err) {
          res.status(500).send('Error updating user settings');
        } else {
          res.redirect('/user/settings');
        }
      });
    }
  });
});




// Handle user logout
router.get('/logout', (req, res) => {
  req.session.destroy();
  res.redirect('/');
});

module.exports = router;
