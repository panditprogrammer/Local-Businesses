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

    if (title.trim() == "") {
        req.flash('errorMessage', 'please fill the title field!');
        return res.redirect('/admin/blogs');

    }

    if (content.trim() == "") {
        req.flash('errorMessage', 'please fill the content field!');
        return res.redirect('/admin/blogs');
    }

    db.run('INSERT INTO blogs (title, content, status) VALUES (?, ?, ?)', [title, content, status], (err) => {
        if (err) throw err;
        res.redirect('/admin/blogs');
    });
});

// Admin - Edit blog form
router.get('/blogs/:id/edit', (req, res) => {
    const blog = req.flash('blog')[0];
    const loggedIn = req.flash('loggedIn')[0];
    const errorMessage = req.flash('errorMessage')[0];

    if (blog) {
        return res.render('admin/edit', { blog, loggedIn, errorMessage });
    } else {
        db.get('SELECT * FROM blogs WHERE id = ?', req.params.id, (err, blog) => {
            if (err) throw err;
            res.render('admin/edit', { blog, loggedIn, errorMessage });
        });
    }
});


// Admin - Update blog
router.put('/blogs/:id', (req, res) => {
    const { title, content, status } = req.body;
    const loggedIn = req.session.userId ? true : false;
    const id = req.params.id;

    if (title.trim() === "") {
        req.flash('errorMessage', 'Please fill the title field!');
        db.get('SELECT * FROM blogs WHERE id = ?', id, (err, blog) => {
            if (err) throw err;
            req.flash('blog', blog);
            req.flash('loggedIn', loggedIn);
            return res.redirect(`/admin/blogs/${id}/edit`);
        });
        return;
    }

    if (content.trim() === "") {
        req.flash('errorMessage', 'Please fill the content field!');
        db.get('SELECT * FROM blogs WHERE id = ?', id, (err, blog) => {
            if (err) throw err;
            req.flash('blog', blog);
            req.flash('loggedIn', loggedIn);
            return res.redirect(`/admin/blogs/${id}/edit`);
        });
        return;
    }

    db.run('UPDATE blogs SET title = ?, content = ?, status = ? WHERE id = ?', [title, content, status, id], (err) => {
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

    if (username.trim() == "") {
        req.flash('errorMessage', 'please fill the username field!');
        return res.redirect(`/admin/settings`);
    }

    if (email.trim() == "") {
        req.flash('errorMessage', 'please fill the email field!');
        return res.redirect(`/admin/settings`);
    }


    // Check if admin exists
    db.get('SELECT * FROM users WHERE role = "admin"', (err, admin) => {
        if (err) {
            req.flash('errorMessage', 'Error fetching admin');
            return res.redirect(`/admin/settings`);
        }

        if (!admin) {
            // If no admin exists, create a new admin
            db.run('INSERT INTO users (username, email, role) VALUES (?, ?, "admin")', [username, email], (err) => {
                if (err) {
                    req.flash('errorMessage', 'Error creating admin');
                    return res.redirect(`/admin/settings`);
                } else {
                    return res.redirect(`/admin/settings`);
                }
            });
        } else {
            // If admin exists, update admin settings
            db.run('UPDATE users SET username = ?, email = ? WHERE role = "admin"', [username, email], (err) => {
                if (err) {
                    req.flash('errorMessage', 'Error updating admin settings');
                    return res.redirect(`/admin/settings`);
                } else {
                    res.redirect('/admin/settings');
                }
            });
        }
    });
});


module.exports = router;