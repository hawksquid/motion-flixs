<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
  <h1 class="text-3xl font-bold text-blue-700">Welcome to Your Dashboard</h1>
  <p class="mt-4 text-gray-700">You have successfully logged in.</p>
</body>
</html>
<?php
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Movie Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 min-h-screen">
  <header class="mb-8">
    <h1 class="text-4xl font-bold text-blue-700">🎬 Movie Dashboard</h1>
    <p class="text-gray-600">Underrated gems worth watching!</p>
  </header>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
    $conn = new mysqli("localhost", "root", "", "movies");

    if ($conn->connect_error) {
      die("<p class='text-red-500'>Connection failed: " . $conn->connect_error . "</p>");
    }

    $sql = "SELECT movie_name, year, genre, rating, description FROM movies LIMIT 50";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $movie = htmlspecialchars($row["movie_name"]);
        $year = htmlspecialchars($row["year"]);
        $genre = htmlspecialchars($row["genre"]);
        $rating = htmlspecialchars($row["rating"]);
        $desc = htmlspecialchars($row["description"]);

        echo "
        <div class='bg-white rounded-2xl shadow-lg p-5 hover:shadow-xl transition duration-300'>
          <h2 class='text-xl font-semibold text-gray-800'>{$movie} <span class='text-sm text-gray-500'>({$year})</span></h2>
          <p class='mt-2 text-sm text-blue-600'>{$genre}</p>
          <p class='mt-2 text-gray-700 text-sm'>{$desc}</p>
          <div class='mt-4 flex justify-between items-center'>
            <span class='text-yellow-500 font-semibold'>⭐ {$rating}</span>
            <button class='text-sm text-blue-600 hover:underline'>More Info</button>
          </div>
        </div>";
      }
    } else {
      echo "<p class='text-gray-600'>No movies found.</p>";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>
