const express = require('express');
const router = express.Router();
const db = require('../database/database');




// Admin - List all blogs
router.get('/blogs', (req, res) => {
    const loggedIn = req.session.userId ? true : false;
    db.all('SELECT * FROM blogs', (err, blogs) => {
        if (err) throw err;
        res.render('admin/index', { blogs, loggedIn });
    });
});

// Admin - New blog form
router.get('/blogs/new', (req, res) => {
    const loggedIn = req.session.userId ? true : false;
    res.render('admin/new', { loggedIn });
});

// Admin - Create new blog
router.post('/blogs/new', (req, res) => {
    const { title, content, status } = req.body;
    db.run('INSERT INTO blogs (title, content, status) VALUES (?, ?, ?)', [title, content, status], (err) => {
        if (err) throw err;
        res.redirect('/admin/blogs');
    });
});

// Admin - Edit blog form
router.get('/blogs/:id/edit', (req, res) => {
    const loggedIn = req.session.userId ? true : false;
    const id = req.params.id;
    db.get('SELECT * FROM blogs WHERE id = ?', id, (err, blog) => {
        if (err) throw err;
        res.render('admin/edit', { blog, loggedIn });
    });
});

// Admin - Update blog
router.put('/blogs/:id', (req, res) => {
    const { title, content, status } = req.body;
    db.run('UPDATE blogs SET title = ?, content = ?, status = ? WHERE id = ?', [title, content, status, req.params.id], (err) => {
        if (err) throw err;
        res.redirect('/admin/blogs');
    });
});

// Admin - Delete blog
router.delete('/blogs/:id', (req, res) => {
    const id = req.params.id;
    db.run('DELETE FROM blogs WHERE id = ?', id, (err) => {
        if (err) throw err;
        res.redirect('/admin/blogs');
    });
});



// Admin setting
router.get('/settings', (req, res) => {
    const loggedIn = req.session.userId ? true : false;
    db.get('SELECT * FROM users WHERE role = "admin"', (err, admin) => {
        if (err) throw err;
        res.render('admin/settings', { admin, loggedIn });
    });
});

// Admin setting
router.post('/settings', (req, res) => {
    const { username, email } = req.body;

    // Check if admin exists
    db.get('SELECT * FROM users WHERE role = "admin"', (err, admin) => {
        if (err) {
            return res.status(500).send('Error fetching admin');
        }

        if (!admin) {
            // If no admin exists, create a new admin
            db.run('INSERT INTO users (username, email, role) VALUES (?, ?, "admin")', [username, email], (err) => {
                if (err) {
                    res.status(500).send('Error creating admin');
                } else {
                    res.redirect('/settings');
                }
            });
        } else {
            // If admin exists, update admin settings
            db.run('UPDATE users SET username = ?, email = ? WHERE role = "admin"', [username, email], (err) => {
                if (err) {
                    res.status(500).send('Error updating admin settings');
                } else {
                    res.redirect('/admin/settings');
                }
            });
        }
    });
});


module.exports = router;