<?php 
/**
 * /controller/CommandeController.php
 * 
 * Contrôleur pour les commandes
 *
 * @author Y.Ennour
 * @date 12/2023
 */


    // Inclure les fichiers PHPMailer
    require_once ROOT.'/PHPMailer/src/Exception.php';
    require_once ROOT.'/PHPMailer/src/PHPMailer.php';
    require_once ROOT.'/PHPMailer/src/SMTP.php';

    require_once ROOT.'/fpdf/fpdf.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

class CommandeController extends Controller {

    public static function nettoyer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    /**
     * Action qui affiche la page Commande
     * params : tableau des paramètres
     */
    public static function show($params){

        if(isset($_SESSION['id'])) {

            // Filtre pour enlever les caractères indésirables
            $idClient = self::nettoyer($_SESSION['id']);

            $lesCmds = CommandeManager::getInfoCmdByClient($idClient);

            // appelle la vue
            $view = ROOT.'/view/historiquecommande.php';

            $params = array();
            $params = [
                'lesCmds' => $lesCmds
            ];
            
            self::render($view, $params);
         
        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }
        

        
    }

    /**
     * Action qui ajoute une cmd
     * params : tableau des paramètres
     */
    public static function newCommande($params){

        if(isset($_SESSION['id'])) {

            if(isset($_SESSION['panier']) && !empty($_SESSION['panier'])){

                if(isset($_SESSION['adresse']) && isset($_SESSION['ville']) && ($_SESSION['adresse'] != '' || $_SESSION['ville'] != '')){     

                // Filtre pour enlever les caractères indésirables
                $idClient = self::nettoyer($_SESSION['id']);
                $adLiv = self::nettoyer($_SESSION['adresse']);
                $cpLiv = self::nettoyer($_SESSION['cp']);
                $villeLiv = self::nettoyer($_SESSION['ville']);

                $panier = $_SESSION['panier'];


                $newCmd = CommandeManager::addCommande($adLiv, $cpLiv, $villeLiv, $idClient);

                $refCmd = $_SESSION['newRef'];

                $i = 0;

                $newStatut = CommandeManager::addStatutCommande($refCmd);
                $client = UtilisateurManager::getClientById($idClient);



                
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Helvetica', 'B', 16); 
                
                $pdf->Image('./img/logo_sitebarbe.png', 10, 10, -300);

                $pdf->SetXY(140, 12); 
                $pdf->Cell(50, 10, 'FACTURE', 1, 0, 'C');

                $pdf->SetFont('Helvetica', 'I', 9); 
                $pdf->SetXY(140, 25);
                $pdf->Cell(0, 10, "Référence : " . $refCmd, 0, 1); 
                $pdf->SetXY(140, 30);
                $pdf->Cell(0, 10, "Date de facturation : " . date("d/m/Y"), 0, 1); 
                $pdf->SetXY(140, 35);
                $pdf->Cell(0, 10, "Référence client : " . $idClient, 0, 1);

                $pdf->SetFillColor(244, 244, 244);
                $pdf->Rect(120, 45, 80, 33, 'F');

                $pdf->SetFont('Helvetica', 'B', 11);
                $pdf->SetXY(120, 45);
                $pdf->Cell(0, 10, $client->getPrenom() . " " . $client->getNom(), 0, 1);

                $pdf->SetFont('Helvetica', '', 10);
                $pdf->SetXY(120, 53);
                $pdf->Cell(0, 10, $client->getAdresse(), 0, 1);
                $pdf->SetXY(120, 58);
                $pdf->Cell(0, 10, $client->getVille() . " " . $client->getCp(), 0, 1);
                $pdf->SetXY(120, 63);
                $pdf->Cell(0, 10, "France", 0, 1);

                if($client->getTelephone() != null){
                    $pdf->SetFont('Helvetica', '', 9);
                    $pdf->SetXY(120, 68);
                    $pdf->Cell(0, 10, "Tél: 0" . $client->getTelephone(), 0, 1);
                }
                


                $pdf->SetFont('Helvetica', 'B', 12); 
                $pdf->SetXY(10, 30);
                $pdf->MultiCell(0, 10, "O'barber");

                $pdf->SetFont('Helvetica', '', 10); 
                $pdf->SetXY(10, 38);
                $pdf->Cell(0, 10, "717 Av. Jean Mermoz", 0, 1);
                $pdf->SetXY(10, 43);
                $pdf->Cell(0, 10, "34000 Montpellier", 0, 1); 
                $pdf->SetXY(10, 48);
                $pdf->Cell(0, 10, "France", 0, 1);
                
                $pdf->SetFont('Helvetica', '', 9); 
                $pdf->SetXY(10, 56);
                $pdf->Cell(0, 10, "Tél: 09 00 00 00 00", 0, 1);
                $pdf->SetXY(10, 61);
                $pdf->Cell(0, 10, "support@obarber.ovh", 0, 1);

                $pdf->SetXY(10, 85);

                $pdf->SetFont('Arial', '', 10);

                // En-têtes de colonne
                $pdf->Cell(100, 10, 'Description', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Prix unit.', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Quantité', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Total', 1, 1, 'C');

                $totalCmd = 0;

                foreach ($panier as $unP) {
                    $idProd = $unP['id'];
                    $qte = $unP['quantite'];
                    $prix = $unP['prix'];
                    $description = $unP['marque'] . " - " . $unP['libelle'];
                    

                    if (strlen($description) > 60) {
                        $description = substr($description, 0, 60) . '...';
                    }

                    $pdf->Cell(100, 10, $description, 1, 0, 'L');
                    $pdf->Cell(30, 10, number_format($prix, 2) . "€", 1, 0, 'C');
                    $pdf->Cell(30, 10, $qte, 1, 0, 'C');
                    $pdf->Cell(30, 10, number_format(($qte * $prix), 2) . "€", 1, 1, 'C');
                    $totalCmd += ($qte * $prix);
                    
                }

                $pdf->SetFont('Helvetica', '', 10); 
                $pdf->SetXY(161, $pdf->GetY() + 8);
                $pdf->Cell(0, 10, "Frais de livraison: 3.50€", 0);
                $pdf->SetXY(161, $pdf->GetY() + 5);
                $pdf->Cell(0, 10, "Total: " . number_format($totalCmd + 3.5, 2). "€", 0);



                
                $pdfNom = 'facture-cmd-'. $refCmd .'.pdf';
                $pdf->Output($pdfNom, 'F');



                // Créer une instance de PHPMailer
                $mail = new PHPMailer();

                // Configurer les paramètres SMTP
                $mail->isSMTP();
                $mail->Host = 'pro3.mail.ovh.net';
                $mail->Port = 587;

                $mail->SMTPAuth = 1;                        

                if($mail->SMTPAuth){
                $mail->SMTPSecure = 'tls';               
                $mail->Username   =  'support@obarber.ovh';   
                $mail->Password   =  'BTSsio2024%';        
                }
                $mail->CharSet = 'UTF-8';


                $mail->setFrom('support@obarber.ovh', 'O\'barber'); // expéditeur
                $mail->addAddress($client->getMail(), $client->getPrenom()); // destinataire

                $mail->isHTML(true);
                $mail->Subject = 'Merci pour ta commande !';

                $message = '<html>
                <head>
                </head>
                <body>
            

                <p style="color: black;">Bonjour '. $client->getPrenom() .', ta commande a bien été reçue.</p>

                <p style="color: black;">N° de commande : '. $refCmd .'</p>
                <p style="color: black;">Date de commande : '. date("d/m/Y") .'</p>


                <p style="color: black;">Détail de livraison</p>
                <p style="color: black;"> '. $client->getPrenom() .' ' . $client->getNom()  .'</p>
                <p style="color: black;"> '. $adLiv .'</p>
                <p style="color: black;"> '. $cpLiv .' ' . $villeLiv  . '</p>

                

                <p style="color: black;"style="color: black;">Cordialement,<br>
                L\'équipe O\'barber</p>
            
            
                <p style="color: #585859; font-size: 12px;">Ceci est un email automatique, merci de ne pas répondre.</p>
                </body>
                </html>';

                $mail->Body = $message;
                $mail->addAttachment($pdfNom, 'facture-cmd-'. $refCmd .'.pdf');


                $mail->send();

                // Envoyer le message débug
                // if ($mail->send()) {
                //     echo 'E-mail envoyé avec succès !'; 
                // } else {
                //     echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
                // }

                
                foreach ($panier as $unP) {
                    $idProd = $unP['id'];
                    $qte = $unP['quantite'];
        
                    $newDetailCmd = CommandeManager::addDetailCommande($refCmd, $idProd, $qte);
                    $i++;
                }

                if($i === count($panier)){
                    CommandeManager::viderPanier();
                }

                if (file_exists($pdfNom)) {
                    unlink($pdfNom);
                }
                
                // appelle la vue
                $view = ROOT.'/view/commande.php';
                $params = array();
                self::render($view, $params);

                } else {

                    $message = 'Veuillez compléter l\'adresse et/ou la ville de livraison.';

                    // appelle la vue
                    $view = ROOT.'/view/profil.php';
                    $params = array();
                    $params = [
                        'message' => $message
                    ];
                    self::render($view, $params);
                }

            } else {
                header('Location: '.SERVER_URL.'/panier/');
            }
         
        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }

        
    }  


    /**
     * Action qui affiche la page detail Commande
     * params : tableau des paramètres
     */
    public static function detailCmd($params){

        if(isset($_SESSION['id'])) {

            // Filtre pour enlever les caractères indésirables
            $refCmd = self::nettoyer($_GET['refCmd']);

            $cmd = CommandeManager::getCmdByRef($refCmd);

            
            $client = UtilisateurManager::getClientById($cmd->getIdClient());
            $dateCmd = CommandeManager::getDateCmdByRef($refCmd);
            $produitCmd = CommandeManager::getProduitCmdByRef($refCmd);
            

            // appelle la vue
            $view = ROOT.'/view/detailcommande.php';

            $params = array();
            $params = [
                'refCmd' => $refCmd,
                'laCmd' => $cmd,
                'leCli' => $client,
                'dateCmd' => $dateCmd,
                'produitCmd' => $produitCmd

            ];
            
            self::render($view, $params);

        } else {
            header('Location: '.SERVER_URL.'/connexion/');
        }
    }
 
}