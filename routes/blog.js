const express = require('express');
const router = express.Router();
const db = require('../database/database');


router.get('/', (req, res) => {
    const loggedIn = req.session.userId ? true : false;
    db.all('SELECT * FROM blogs WHERE status = "publish"', (err, blogs) => {
        if (err) throw err;

        // get admin user
        db.get('SELECT * FROM users WHERE role = "admin"', (err, admin) => {
            if (err) {
                return res.send('Error fetching admin');
            }
            res.render('index', { blogs, loggedIn, admin });
        })

    });
});



// Show blog details
router.get('/blog/:id', (req, res) => {
    const loggedIn = req.session.userId ? true : false;
    const blogId = req.params.id;

    // Query the blog details and its comments
    db.get('SELECT *, likes_count AS likeCount FROM blogs WHERE id = ?', [blogId], (err, blog) => {
        if (err) {
            console.error('Error retrieving blog details:', err);
            res.send('Error retrieving blog details');
            return;
        }

        if (!blog) {
            res.send('Blog not found');
            return;
        }



        // Query comments for the blog with user information
        db.all('SELECT comments.*, users.username AS commenter_name, users.email AS commenter_email ' +
            'FROM comments ' +
            'JOIN users ON comments.user_id = users.id ' +
            'WHERE comments.blog_id = ?',
            [blogId],
            (err, comments) => {
                if (err) {
                    console.error('Error retrieving comments:', err);
                    res.send('Error retrieving comments');
                    return;
                }

                // get admin user
                db.get('SELECT * FROM users WHERE role = "admin"', (err, admin) => {
                    if (err) {
                        return res.send('Error fetching admin');
                    }

                    // Render the blog details page with blog, comments, and likeCount
                    res.render('blog', { blog, comments, loggedIn, admin });
                })
            });
    });
});



// // Route to handle liking a blog post
router.post('/blog/:id/like', (req, res) => {
    const loggedIn = req.session.userId ? true : false;
    if (!req.session.userId) {
        return res.json({ success: false, message: "Login required" });
    }

    const blogId = req.params.id;
    const userId = req.session.userId;

    db.run('INSERT INTO likes (blog_id, user_id) VALUES (?, ?)', [blogId, userId], (err) => {
        if (err) {
            res.json({ success: false, message: 'Error adding like' });
        } else {
            db.run('UPDATE blogs SET likes_count = likes_count + 1 WHERE id = ?', [blogId], (err) => {
                if (err) {
                    res.json({ success: false, message: 'Error updating like count' });
                } else {
                    db.get('SELECT likes_count FROM blogs WHERE id = ?', [blogId], (err, row) => {
                        if (err) {
                            res.json({ success: false, message: 'Error retrieving like count' });
                        } else {
                            res.json({ success: true, likeCount: row.likes_count, loggedIn });
                        }
                    });
                }
            });
        }
    });
});

// Route to handle unliking a blog post
router.post('/blog/:id/unlike', (req, res) => {

    if (!req.session.userId) {
        return res.json({ success: false, message: "Login required" });
    }

    const blogId = req.params.id;
    const userId = req.session.userId;

    db.run('DELETE FROM likes WHERE blog_id = ? AND user_id = ?', [blogId, userId], (err) => {
        if (err) {
            res.json({ success: false, message: 'Error removing like' });
        } else {
            db.run('UPDATE blogs SET likes_count = likes_count - 1 WHERE id = ?', [blogId], (err) => {
                if (err) {
                    res.json({ success: false, message: 'Error updating like count' });
                } else {
                    db.get('SELECT likes_count FROM blogs WHERE id = ?', [blogId], (err, row) => {
                        if (err) {
                            res.json({ success: false, message: 'Error retrieving like count' });
                        } else {
                            res.json({ success: true, likeCount: row.likes_count });
                        }
                    });
                }
            });
        }
    });
});

// Check if a user has liked a blog post
router.get('/blog/:id/hasLiked', (req, res) => {

    if (!req.session.userId) {
        return res.json({ hasLiked: false });
    }

    const blogId = req.params.id;
    const userId = req.session.userId;

    db.get('SELECT 1 FROM likes WHERE blog_id = ? AND user_id = ?', [blogId, userId], (err, row) => {
        if (err) {
            res.json({ hasLiked: false });
        } else {
            res.json({ hasLiked: !!row });
        }
    });
});

// Add a comment
router.post('/blog/:id/comment', (req, res) => {
    if (!req.session.userId) {
        return res.redirect('/user/login');
    }

    const blogId = req.params.id;
    const { content } = req.body;
    const userId = req.session.userId;

    db.serialize(() => {
        // Insert the comment
        db.run('INSERT INTO comments (blog_id, user_id, content) VALUES (?, ?, ?)', [blogId, userId, content], (err) => {
            if (err) {
                console.error('Error adding comment:', err);
                res.send('Error adding comment');
                return;
            }

            // Increment comments_count in the blogs table
            db.run('UPDATE blogs SET comments_count = comments_count + 1 WHERE id = ?', [blogId], (err) => {
                if (err) {
                    console.error('Error updating comments_count:', err);
                    res.send('Error updating comments_count');
                } else {
                    res.redirect(`/blog/${blogId}`);
                }
            });
        });
    });
});


module.exports = router;