const express = require('express');
const bodyParser = require('body-parser');
const methodOverride = require('method-override');
const db = require('./database/database');
const app = express();
const port = 3000;



app.set('view engine', 'ejs');
// app.use(express.static('public'));
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.json());
app.use(methodOverride('_method'));

// List all blogs
app.get('/', (req, res) => {
  db.all('SELECT * FROM blogs WHERE status = "publish"', (err, blogs) => {
    if (err) throw err;
    res.render('index', { blogs });
  });
});

// Show blog details
app.get('/blog/:id', (req, res) => {
  const blogId = req.params.id;

  // Query the blog details and its comments
  db.get('SELECT *, likes_count AS likeCount FROM blogs WHERE id = ?', [blogId], (err, blog) => {
    if (err) {
      console.error('Error retrieving blog details:', err);
      res.status(500).send('Error retrieving blog details');
      return;
    }

    if (!blog) {
      res.status(404).send('Blog not found');
      return;
    }

    // Query comments for the blog
    db.all('SELECT * FROM comments WHERE blog_id = ?', [blogId], (err, comments) => {
      if (err) {
        console.error('Error retrieving comments:', err);
        res.status(500).send('Error retrieving comments');
        return;
      }

      // Render the blog details page with blog, comments, and likeCount
      res.render('blog', { blog, comments });
    });
  });
});



// Route to handle liking a blog post
app.post('/blog/:id/like', (req, res) => {
  const blogId = req.params.id;

  // Increment likes_count in the database
  db.run('UPDATE blogs SET likes_count = likes_count + 1 WHERE id = ?', [blogId], function (err) {
    if (err) {
      console.error('Error liking blog:', err);
      res.status(500).json({ success: false, error: 'Failed to like the blog.' });
    } else {
      // Return updated like count
      db.get('SELECT likes_count FROM blogs WHERE id = ?', [blogId], (err, row) => {
        if (err) {
          console.error('Error retrieving like count after like:', err);
          res.status(500).json({ success: false, error: 'Failed to retrieve like count.' });
        } else {
          res.json({ success: true, likeCount: row.likes_count });
        }
      });
    }
  });
});

// Route to handle unliking a blog post
app.delete('/blog/:id/unlike', (req, res) => {
  const blogId = req.params.id;

  // Decrement likes_count in the database
  db.run('UPDATE blogs SET likes_count = likes_count - 1 WHERE id = ?', [blogId], function (err) {
    if (err) {
      console.error('Error unliking blog:', err);
      res.status(500).json({ success: false, error: 'Failed to unlike the blog.' });
    } else {
      // Return updated like count
      db.get('SELECT likes_count FROM blogs WHERE id = ?', [blogId], (err, row) => {
        if (err) {
          console.error('Error retrieving like count after unlike:', err);
          res.status(500).json({ success: false, error: 'Failed to retrieve like count.' });
        } else {
          res.json({ success: true, likeCount: row.likes_count });
        }
      });
    }
  });
});




// Add a comment
app.post('/blog/:id/comment', (req, res) => {
  const blogId = req.params.id;
  const { content } = req.body;
  db.run('INSERT INTO comments (blog_id, content) VALUES (?, ?)', [blogId, content], (err) => {
    if (err) throw err;
    res.redirect(`/blog/${blogId}`);
  });
});


// Admin - List all blogs
app.get('/admin/blogs', (req, res) => {
  db.all('SELECT * FROM blogs', (err, blogs) => {
    if (err) throw err;
    res.render('admin/index', { blogs });
  });
});

// Admin - New blog form
app.get('/admin/blogs/new', (req, res) => {
  res.render('admin/new');
});

// Admin - Create new blog
app.post('/admin/blogs', (req, res) => {
  const { title, content, status } = req.body;
  db.run('INSERT INTO blogs (title, content, status) VALUES (?, ?, ?)', [title, content, status], (err) => {
    if (err) throw err;
    res.redirect('/admin/blogs');
  });
});

// Admin - Edit blog form
app.get('/admin/blogs/:id/edit', (req, res) => {
  const id = req.params.id;
  db.get('SELECT * FROM blogs WHERE id = ?', id, (err, blog) => {
    if (err) throw err;
    res.render('admin/edit', { blog });
  });
});

// Admin - Update blog
app.put('/admin/blogs/:id', (req, res) => {
  const { title, content, status } = req.body;
  db.run('UPDATE blogs SET title = ?, content = ?, status = ? WHERE id = ?', [title, content, status, req.params.id], (err) => {
    if (err) throw err;
    res.redirect('/admin/blogs');
  });
});

// Admin - Delete blog
app.delete('/admin/blogs/:id', (req, res) => {
  const id = req.params.id;
  db.run('DELETE FROM blogs WHERE id = ?', id, (err) => {
    if (err) throw err;
    res.redirect('/admin/blogs');
  });
});

// start the server 
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
