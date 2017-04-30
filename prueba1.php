<?php
/**
 * Created by PhpStorm.
 * User: Jesus Tovar
 * Date: 01/05/2017
 * Time: 12:36 AM
 */
$requete = 'SELECT * FROM '.$_SESSION['table'].' WHERE id_resource='. $_SESSION['id_res'].' AND code="fr" AND status=1';
$recupcont = mysql_query($requete);
$fichier="";
while ($data= mysql_fetch_assoc($recupcont)){
    $nombre_archivo = "ressources/".$_SESSION['id_res']."_".$_SESSION['id'].".srt";
    $fichier=$nombre_archivo;
    if(file_exists($nombre_archivo))
    {
        $mensaje =$data['text'];
    }

    else
    {
        $mensaje =$data['text'];
    }

    if($archivo = fopen($nombre_archivo, "w"))
    {
        if(fwrite($archivo,   $mensaje))
        {
            echo "";//Cambiar
        }
        else
        {
            echo "";//Cambiar
        }

        fclose($archivo);
    }
}

$num=0;
$nombre=0;

if (file_exists($fichier)) {

    $lignes = file($fichier);
    /*$lignes=str_replace("Ã´","ô",$lignes);
    $lignes=str_replace("Ã©","é",$lignes);
    $lignes=str_replace("Ã","à",$lignes);
    $lignes=str_replace("à¨","è",$lignes);
    $lignes=str_replace("àª","ê",$lignes);
    $lignes=str_replace("à§","ç",$lignes);
    $lignes=str_replace("à»","û",$lignes);
    $lignes=str_replace("à¢","â",$lignes);
    $lignes=str_replace(chr(13),"",$lignes);
    $lignes=str_replace(chr(10),"",$lignes);
    $lignes=str_replace("  "," ",$lignes);
    $lignes=str_replace("à ","à",$lignes);
    $lignes=str_replace("à¹","ù",$lignes);
    $lignes=str_replace("ù ","ù",$lignes);
    $lignes=str_replace("î ","î",$lignes);
    $lignes=str_replace("ï ","ï",$lignes);
    $lignes=str_replace("â ","â",$lignes);*/


    $Assembleligne="";
    foreach($lignes as $ligne_num => $ligne) { // on lit le fichier de fa�on s�quentielle

        $ligne = str_replace(",000",",010",$ligne);
        if (strlen($ligne)>5) {
            if (substr($ligne,0,1)=="0") {
                $nombre=$nombre+1;
                $element = explode(" --> ", $ligne);

                echo '<tr>';
                echo '<td align="left" colspan"2">';
                $num=$num+1;
                echo '<a name="'.$num.'"></a>';
                echo '<span class="texte_note">'.$num.'</span>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="left">';

                if ($_SESSION['niveau']<40) {
                    echo '<div class="stbuttonpublierST" >'.$element[0].'</div>';
                } else {
                    echo '<input type="text" name="in'.$num.'" value="'.$element[0].'" size="12"  disabled>';
                }
                echo '</td>';
                echo '<td align="center">';
                echo '</td>';
                echo '<td align="right">';
                if ($_SESSION['niveau']<40) {
                    echo '<div class="stbuttonpublierST" >'.$element[1].'</div>';
                } else {
                    echo '<input type="text" name="out'.$num.'" value="'.$element[1].'" size="12"  disabled>';
                }

                echo '</td>';
                echo '<tr>';
            } else {
                if (strlen($ligne)>2) {
                    $Assembleligne = $Assembleligne.chr(10).$ligne;

                }
            }

        } else {
            if ($Assembleligne<>"") {
                echo '<tr>';
                echo '<td colspan="3">';
                echo '<center>';
                echo '<textarea name="texte'.$num.'" cols="36" rows="5"  disabled>'.$Assembleligne.'</textarea>';
                echo '</center>';
                echo '</td>';
                echo '<tr>';

                echo '<tr>';

                echo '<td colspan="3">';
                echo '&nbsp;';
                echo '</td>';

                echo '</tr>';
                $Assembleligne="";
            }
        }
    }
}