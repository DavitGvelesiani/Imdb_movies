<?php

    //connecting to mysql database
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=imdb_movies', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //getting existing data from database
    $movies_statement = $pdo->prepare('SELECT * FROM movies');
    $movies_statement->execute();
    $saved_movies = $movies_statement->fetchAll(PDO::FETCH_ASSOC);

?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>IMDB movies</title>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class='bg-sky-900 m-px'>
        <a href='loaded_movies.php'>
            <button class="m-2 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                Loaded movies
            </button>
        </a>


        <?php if (empty($_POST)) {?>
            <form method="POST">        
                <input class="
                    max-w-lg
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-auto
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="text" name="movieName" placeholder="Enter movie name" />      
                <button class='block m-auto px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800' type="submit" name="submit">Search</button>
            </form>
            
        <?php } else{

            if(isset($_POST['submit'])){
                if (empty($_POST)){
                    echo 'Enter the movie name';
                }

                //fetching data from api
                $movie_name = $_POST['movieName'];
                $api_url = "https://www.omdbapi.com/?apikey=58a1ad7f&t=$movie_name";
                $json_data = file_get_contents($api_url);
                $movie_data = json_decode($json_data);

                $title = $movie_data->Title;
                $year = $movie_data->Year;
                $image_url = $movie_data->Poster;
                $genre = $movie_data->Genre;
                $director = $movie_data->Director;
                $actors = $movie_data->Actors;
                $rating = $movie_data->imdbRating;

                //checking if movie exists in database or not
                $movie_exists = in_array($title, array_column($saved_movies, 'title'));

                if(!$movie_exists){
                    //saving image from URL
                    $trimmed_title = preg_replace('/\s+/', '', $title);
                    $img = "uploads/$trimmed_title.png"; 
                    file_put_contents($img, file_get_contents($image_url));

                    //saving data in mysql
                    $statement = $pdo->prepare("INSERT INTO movies (title, year, image, genre, director, actors, rating)
                                    VALUES (:title, :year, :image, :genre, :director, :actors, :rating)");

                    $statement->bindValue(':title', $title);
                    $statement->bindValue(':year', $year);
                    $statement->bindValue(':image', $img);
                    $statement->bindValue(':genre', $genre);
                    $statement->bindValue(':director', $director);
                    $statement->bindValue(':actors', $actors);
                    $statement->bindValue(':rating', $rating);

                    $statement->execute();
                    
                    //getting new data after adding new item
                    $movies_statement = $pdo->prepare('SELECT * FROM movies');
                    $movies_statement->execute();
                    $saved_movies = $movies_statement->fetchAll(PDO::FETCH_ASSOC);
                }
                    
                
                $index = array_search($title, array_column($saved_movies, 'title'));
                ?>
                    <div class="flex justify-center">
                        <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                            <img class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" src=<?php echo $saved_movies[$index]['image'] ?> />
                            <div class="p-6 flex flex-col justify-start">
                                <h2 class="text-gray-900 text-xl font-medium mb-2"><?php echo $saved_movies[$index]['title'] ?></h2>
                                <p class="text-gray-700 text-base mb-4">Year: <?php echo $saved_movies[$index]['year'] ?></p>
                                <p class="text-gray-600 text-xs">Genre: <?php echo $saved_movies[$index]['genre'] ?></p>
                                <p class="text-gray-600 text-xs">Director: <?php echo $saved_movies[$index]['director'] ?></p>
                                <p class="text-gray-600 text-xs">Actors: <?php echo $saved_movies[$index]['actors'] ?></p>
                                <p class="text-gray-700 text-base mb-4">IMDB rating: <?php echo $saved_movies[$index]['rating'] ?></p>
                            </div>
                            
                        </div>
                    </div>
                    
                <?php        
            }
            
        }  ?>    
        
    </body>

</html>