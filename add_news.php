<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New News - Minimalist News</title>

  <!-- Link to the external stylesheet -->
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

  <!-- Header -->
  <header>
    <h1>Minimalist News</h1>
  </header>

  <!-- Add New News Form -->
  <div class="news-container">

    <h2>Add New News</h2>

    <form action="processAddNews.php" method="post">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>

      <label for="body">Body:</label>
      <textarea id="body" name="body" rows="4" required></textarea>

      <button type="submit" class="btn">Submit</button>
    </form>

  </div>

</body>

</html>
