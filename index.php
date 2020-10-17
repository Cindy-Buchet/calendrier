<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>PHP Ex dates TP</title>
</head>
<body>
<?php
    if(isset($_POST['mois']) && ($_POST['annee'])){
        $mois = $_POST['mois'];
        $annee = $_POST['annee'];
    } else {
        $mois = date('m');
        $annee = date('Y');
    }

    $arrayMonth = array(
        '01' => 'Janvier',
        '02' => 'Février',
        '03' => 'Mars',
        '04' => 'Avril',
        '05' => 'Mai',
        '06' => 'Juin',
        '07' => 'Juillet',
        '08' => 'Août',
        '09' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre'
    );

    $arrayYears = array(2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020,2021);

?>
<section class="container">
    <div class="row">
        <form method="post" enctype="multipart/form-data">
                    
            <div class="offset-2 col-3">
                <label for="mois">Mois</label>

                    <select name="mois" class="form-control" >
                    <?php
                        foreach($arrayMonth as $key => $value){
                            echo '<option value="' . $key . '"';
                            if ($key == $mois){
                                echo ' selected';
                            }
                            echo '>' . $value . '</option>';
                        }
                    ?>
                    </select>
            </div>
                
            <div class="offset-sm-1 col-3">
                <label for="annee">Année</label>

                    <select name="annee" class="form-control ">
                    <?php
                        foreach($arrayYears as $value){
                            echo '<option value="' . $value . '"';
                            if ($value == $annee){
                                echo ' selected';
                            }
                            echo '>' . $value . '</option>';
                        }
                    ?>
                    </select>
            </div>
            
            <div class="offset-sm-1 col-2">
                <button type="submit" class="btn btn-primary mb-4 btn-envoi">Envoyer</button>
            </div>

        </form>
    </div>

    <table class="table">


    <?php


        echo "<caption>";
        foreach($arrayMonth as $k => $v){
            if($mois == $k){
                echo  $v . " <br/>";
            }
        }
        echo $annee;
        echo "</caption>";

        // Afficher les jours sur le calendrier
        $jours = array("LUN", "MAR", "MER", "JEU","VEN","SAM","DIM");


        echo "<tr>";
            for ($x = 0; $x < 7; $x++){
                echo "<th>". $jours[$x] . "</th>";
            }
        echo "</tr>";


        // Nombre de jours sur le mois
        $tabl = cal_days_in_month(CAL_GREGORIAN, $mois, $annee); 

        // Quel jour de la semaine
        $ict =  date('N',strtotime("$annee/$mois/1"));

        //Timeslamp 
        $vieux = mktime(15, 00, 00, $mois, 0, $annee);

        $entrees = $tabl + $ict - 1;

        if($entrees <= 35){
            $nmbrEntrees = 35;
        } else {
            $nmbrEntrees = 42;
        }

        for($x = 1; $x <= $nmbrEntrees; $x++){
            if($x >= $ict){
                $vieux += 86400; // On incrémente au timestamp 86400s par jour
                $jour = date('d',$vieux); 
                $class = NULL;  
            } else {
                $jour = NULL;
                $class = 'tdVide';
            }

            if(date('m',$vieux) != $mois){
                $jour = NULL;
                $class = 'tdVide';
            }

            $calcul = $x % 7;
            if($calcul == 1){
                echo "<tr> <td>" . $jour . "</td>";
            } else if ($calcul == 0){
                echo "<td>" . $jour . "</td> </tr>";
            } else {
                echo "<td class='tdStyle'>" . $jour . "</td>";
            }
            
        }


    ?>
</section>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>