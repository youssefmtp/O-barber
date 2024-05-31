<?php
$title = 'Les Clients | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/clients.css" rel="stylesheet"> 

    <div class="container">
        <h4 class="titreClient">Gestion des clients</h4>
    </div>

    <?php 

        if(isset($messageConf)){
            echo '<p class="message-info">' . $messageConf . '</p>';
        }

    ?>




    <div class="container divEte">

        <table class="table tabCli">
            <tr class="entete">
                <td class="lblEte"> NOM </td>
                <td class="lblEte"> PRENOM </td>
                <td class="lblEte"> EMAIL </td>
                <td class="lblEte"> MOT DE PASSE </td>
                <td class="lblEte"> ACTION </td>
            </tr>

            
            <?php 
                foreach($lesClients as $unC){
                    echo '<tr>';
                        echo '<td class="lblClients"> <p> '. $unC->getNom() .' </p> </td>';
                        echo '<td class="lblClients"> <p> '. $unC->getPrenom() .' </p> </td>';
                        echo '<td class="lblClients"> <p> '. $unC->getMail() .' </p> </td>';
                        echo '<td class="lblClients"> <a href="'. SERVER_URL . '/clients/resetPassword/' . $unC->getId(). '/" class="linkClient"> Réinitialiser le mot de passe </a> </td>';
                        echo '<td class="lblClients"> <i class="fa-solid fa-trash iconTrash" onclick="modalDeleteClient('. $unC->getId() .')"></i></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>


    <div id="modalConfirmation"></div>

    <br><br><br>



    <script src="/js/clients.js"></script>

    


<?php
include 'footer.php';
?>