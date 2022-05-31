<?php

    //connecting to mysql database
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=imdb_movies', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //getting existing data from database
    $movies_statement = $pdo->prepare('SELECT * FROM movies');
    $movies_statement->execute();
    $saved_movies = $movies_statement->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <title>Loaded movies</title>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class='bg-sky-900 m-px'>
        <a href='index.php'>
            <button class="m-2 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                Main
            </button>
        </a>

        <?php foreach ($saved_movies as $movie){ ?>
            
            <div class="flex justify-center my-5">
                <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                    <img class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" src=<?php echo $movie['image'] ?> />
                    <div class="p-6 flex flex-col justify-start">
                        <h2 class="text-gray-900 text-xl font-medium mb-2"><?php echo $movie['title'] ?></h2>
                        <p class="text-gray-700 text-base mb-4">Year: <?php echo $movie['year'] ?></p>
                        <p class="text-gray-600 text-xs">Genre: <?php echo $movie['genre'] ?></p>
                        <p class="text-gray-600 text-xs">Director: <?php echo $movie['director'] ?></p>
                        <p class="text-gray-600 text-xs">Actors: <?php echo $movie['actors'] ?></p>
                        <p class="text-gray-700 text-base mb-4">IMDB rating: <?php echo $movie['rating'] ?></p>
                    </div>                            
                </div>
            </div>

        <?php } ?>

    </body>
</html>