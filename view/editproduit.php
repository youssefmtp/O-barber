<?php
$title = 'Modifier le produit | O\'Barber';
include 'header.php';
?>

    <link href="<?= SERVER_URL ?>/css/editproduit.css" rel="stylesheet"> 

    <div class="container divGEdit">
        <h5 class="titreEp">Modifier le produit</h5>

        <form method="POST" action="<?= SERVER_URL?>/editproduit/" enctype="multipart/form-data">

            <div display: hidden>
                <input type="text" name="idProd" value="<?= $unProduit->getId()?>" >
            </div>

            <div class="row divP">
                <div class="form-group col-md-6">
                    <label for="marque" class="lblEdit">Marque du produit</label>
                    <input type="text" class="form-control inputEdit" id="marque" name="marque" value="<?= $unProduit->getMarque()?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="refProd" class="lblEdit">Référence du produit</label>
                    <input type="text" class="form-control inputEdit" id="refProd" name="refProd" value="<?= $unProduit->getRefProd()?>">
                </div>
            </div>

            <div class="row divP">
                <div class="form-group col-md-6">
                    <label for="libelle" class="lblEdit">Intitulé du produit</label>
                    <input type="text" class="form-control inputEdit" id="libelle" name="libelle" value="<?= $unProduit->getLibelle()?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="prix" class="lblEdit">Prix du produit</label>
                    <input type="text" class="form-control inputEdit" id="prix" name="prix" value="<?= number_format($unProduit->getPrix(), 2)?>€">
                </div>
            </div>

            <div class="row divP">
                <div class="form-group col-md-6">
                    <label for="resume" class="lblEdit">Résumé court du produit</label>
                    <textarea class="form-control inputEdit" id="resume" rows="4" name="resume" placeholder="maximum 260 caractères"><?= $unProduit->getResume()?></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="description" class="lblEdit">Description complète du produit</label>
                    <textarea class="form-control inputEdit" id="description" rows="4" name="description" placeholder="maximum 556 caractères"><?= $unProduit->getDescription()?></textarea>
                </div>
            </div>

            

            <div class="row divP">

                <div class="form-group col-md-6">
                    <label for="qteStock" class="lblEdit">Quantité en stock</label>
                    <input type="text" class="form-control inputEdit" id="qteStock" name="qteStock" value="<?= $unProduit->getQteEnStock()?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="seuilAlerte" class="lblEdit">Seuil d'alerte</label>
                    <input type="text" class="form-control inputEdit" id="seuilAlerte" name="seuilAlerte" value="<?= $unProduit->getSeuilAlerte()?>">
                </div>
            </div>


            <div class="row divP">

                <div class="form-group col-md-6">
                    <label for="photoProd" class="lblEdit">Modifier la photo du produit</label>
                    <input type="file" class="form-control inputEdit" id="photoProd" name="photoProd">
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
            
        
            <div class="divBtnsAction">
                <button type="submit" class="btnModifier">Modifier</button>
                <button type="button" onclick="supprimerProd(<?= $unProduit->getId() ?>)" class="btnSupprimer">Supprimer</button>
            </div>
        </form>


        
    </div>

    <script src="/js/editproduit.js"></script>

<?php
include 'footer.php';
?>