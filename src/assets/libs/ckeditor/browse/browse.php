<?php
// CONFIGURACIÓN
//*******************************************************
$rutaFinalImagenes = __DIR__."/../imagenescontenido";  
//*******************************************************
$rutaSinRaiz = substr($rutaFinalImagenes, strlen($_SERVER["DOCUMENT_ROOT"]));
?>
<html>  
    <head>  
        <title>Seleccione fichero</title>  
        <meta charset="utf-8">  
        <style type="text/css">  
            .elemento .imagen{
                background-size: cover;
                width: 200px;
                height: 200px;                
            }
            .elemento {
                margin-right: 1%;
                height: 250px;
                overflow: auto;
                width: 200px;
                float: left;
                cursor: pointer;
            }
            .nombreImagen{
                text-align: center;
            }

        </style> 

    </head>  


    <body>  
        <div id="contenedorImagenes">
            <?php
            $directorioImagenes =$rutaFinalImagenes;
            $directorio = $directorioImagenes;
            $directorio = opendir($directorio);

            while ($archivo = readdir($directorio)) {
                if (!is_dir($archivo)) {
                    ?>
                    <div class="elemento" onclick='OpenFile("<?= $rutaSinRaiz."/".$archivo ?>")'>
                        <div class="imagen" style='background-image: url("<?= $rutaSinRaiz . "/" . $archivo ?>")'>                            
                        </div>
                        <p class='nombreImagen'><?= $archivo ?> </p> 
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <script>           
            
             function OpenFile(fileUrl)
             {
             
             //PATCH: Using CKEditors API we set the file in preview window.	
             
             funcNum = "<?= $_GET["CKEditorFuncNum"] ?>";
             //fixed the issue: images are not displayed in preview window when filename contain spaces due encodeURI encoding already encoded fileUrl
             window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
             
             ///////////////////////////////////
             window.close();
             }
        </script>


    </body>  

</html>  