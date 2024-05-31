<?php
$title = 'Nouveau produit | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/nouveauproduit.css" rel="stylesheet"> 

    <div class="container divGAdd">

        <form action="<?= SERVER_URL ?>/produit/nouveau/" method="POST" name="formNewProd" enctype="multipart/form-data">

            <h5 class="titreNp">Nouveau produit</h5>

            <div> <p class="msgErreur"> <?php if(isset($erreur)){ echo $erreur ;} ?></p></div>
            <div> <p class="msgInfo"> <?php if(isset($message)){ echo $message ;} ?></p></div>

            <div class="row divP">

                <div class="form-group col-md-6">
                    <label for="marque" class="lblAddProd">Marque du produit</label>
                    <input type="text" class="form-control inputNvProd" id="marque" name="marque" placeholder="nom de la marque">
                </div>

                <div class="form-group col-md-6">
                    <label for="refProd" class="lblAddProd">Référence du produit</label>
                    <input type="text" class="form-control inputNvProd" id="refProd" name="refProd" placeholder="ex: marque-type-num">
                </div>
            </div>

            <div class="row divP">
                <div class="form-group col-md-6">
                    <label for="libelle" class="lblAddProd">Intitulé du produit</label>
                    <input type="text" class="form-control inputNvProd" id="libelle" name="libelle" placeholder="ex: huile adoucissante pour barbe">
                </div>

                <div class="form-group col-md-6">
                    <label for="prix" class="lblAddProd">Prix du produit</label>
                    <input type="text" class="form-control inputNvProd" id="prix" name="prix" placeholder="ex: 19.99">
                </div>
            </div>

            <div class="row divP">
                <div class="form-group col-md-6">
                    <label for="resume" class="lblAddProd">Résumé court du produit</label>
                    <textarea class="form-control inputNvProd" id="resume" name="resume" rows="4" placeholder="maximum 260 caractères" maxlength="250"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="description" class="lblAddProd">Description complète du produit</label>
                    <textarea class="form-control inputNvProd" id="description" rows="4" name="description" placeholder="maximum 556 caractères" maxlength="546"></textarea>
                </div>
            </div>

            

            <div class="row divP">

                <div class="form-group col-md-6">
                    <label for="qteStock" class="lblAddProd">Quantité en stock</label>
                    <input type="text" class="form-control inputNvProd" id="qteStock" name="qteStock" placeholder="ex: 20">
                </div>

                <div class="form-group col-md-6">
                    <label for="seuilAlerte" class="lblAddProd">Seuil d'alerte</label>
                    <input type="text" class="form-control inputNvProd" id="seuilAlerte" name="seuilAlerte" placeholder="ex: 5">
                </div>
            </div>


            <div class="row divP">

                <div class="form-group col-md-6">
                    <label for="photoProd" class="lblAddProd">Photo du produit</label>
                    <input type="file" class="form-control inputNvProd" id="photoProd" name="photoProd" accept="image/png, image/jpg">
                </div>
                
                <div class="form-group col-md-6">
                <select name="categorie" id="categ-select" class="form-control selectCateg">
                    <option value="">Sélectionner une sous-catégorie</option>
                    <?php
                    foreach($lesSousCategs as $uneSousCateg){
                        echo '<option value="'. $uneSousCateg->getId() .'">'. $uneSousCateg->getLibelle() .'</option>';
                    }
                    
                    ?>
                    
                </select>
                </div>

            </div>
            

        
            <div class="divBtnValider">
                <button type="submit" class="btnAjouter">Ajouter</button>
            </div>
            
        </form>

    </div>



<?php
include 'footer.php';
?>