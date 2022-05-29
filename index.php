<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <input id="Search" type="search" name="q" placeholder="rechercher un film">
        <input id="btnSearch" type="submit" value="Rechercher">
    </form>
    <?php 
        $films = file_get_contents('app.json');
        $films = json_decode($films, true);

        if (isset($_GET['q']) AND !empty($_GET['q'])) {
            $q = htmlspecialchars($_GET['q']);

            for ($i=0; $i < count($films); $i++){
                if ($films[$i]['name'] == $q){
                    $film = $films[$i]['name'];
                    echo "<li> $film </li>";
                }
            };
        }else{

            for ($i=0; $i < count($films); $i++){
                $film = $films[$i]['name'];
                echo "<li> $film </li>";
            };

        };
    ?>

 
<script>
        import axiosClient from "./axiosClient";

export const category = {
    movie: "movie",
    tv: "tv"
}

export const movieType = {
    upcoming: "upcoming",
    popular: "popular",
    top_rated: "top_rated"
}

export const tvType = {
    popular: "popular",
    top_rated: "top_rated",
    on_the_air: "on_the_air"
}

const tmdbApi = {
    getMoviesList: (type, params) => {
        const url = "movie/" + movieType[type];
        return axiosClient.get(url, params);
    },

    getTvList: (type, params) => {
        const url = "tv/" + movieType[type];
        return axiosClient.get(url, params);
    },

    getVideos: (cate, id) => {
        const url = category[cate] + "/" + id + "/videos";
        return axiosClient.get(url, {params: {}});
    },

    search: (cate, params) => {
        const url = "search/" + category[cate];
        return axiosClient.get(url, params);
    },

    detail: (cate, id, params) => {
        const url = category[cate] + "/" + id;
        return axiosClient.get(url, params);
    },

    credits: (cate, id) => {
        const url = category[cate] + "/" + id + "/credits";
        return axiosClient.get(url, {params: {}});
    },

    similar: (cate, id) => {
        const url = category[cate] + "/" + id + "/similar";
        return axiosClient.get(url, {params: {}});
    }
}

export default tmdbApi;
    </script>
</body>
</html>