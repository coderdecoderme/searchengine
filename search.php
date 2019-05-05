<?php

	if(isset($_GET["term"])) {
		$term = $_GET["term"];
	}
	else {
		exit("You must enter a search term");
	}

	$type = isset($_GET["type"]) ? $_GET["type"] : "sites";


	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>SEARCH ENGINE | SEARCH</title>
</head>
<body>
    <!-- BASE WRAPPER -->
<div class="wrapper">
	<!-- HEADER -->
    <div class="header">
        <!-- HEADER CONTENT -->
        <div class="headerContent">

            <div class="logoContainer">
                <a href="index.php">
                    <img src="img/doodleLogo.png">
                </a>
            </div>

            <!-- SEARCH CONTAINER -->
            <div class="searchContainer">

                <form action="search.php" method="GET">

                    <div class="searchBarContainer">
                        <!-- SEARCH INPUT -->
                        <input class="searchBox" type="text" name="term">
                        <button class="searchButton">
                            <img src="img/search.png">
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <!-- SITES & IMAGES TAB -->
        <div class="tabsContainer">

            <ul class="tabList">

                <li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
                    <a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
                    Sites
                </a>
                </li>

                <li class="<?php echo $type == 'images' ? 'active' : '' ?>">
                    <a href='<?php echo "search.php?term=$term&type=images"; ?>'>
                        Images
                    </a>
                </li>

            </ul>


        </div>



    </div>
</div>

</body>
</html>