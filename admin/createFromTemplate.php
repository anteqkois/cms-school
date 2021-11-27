<?php

if( count( $_GET ) )
{
    require '../polacz_z_baza.php';
    
    
    $template = $sql->query('SELECT `structureOfTemplate`, `nameOftemplate` FROM `template` WHERE nameOfTemplate="' . $_GET ['nameOfTemplate'] .'"')->fetch( PDO::FETCH_ASSOC );
    
    $structureTemplate = json_decode($template['structureOfTemplate']);

    $html = '<h1>Tworzysz stronę z szablonu: "'. $template['nameOftemplate']  .'"</h1><form action="createFromTemplateAction.php?template='.$_GET ['nameOfTemplate'].'" method="post">url<br><input type="text" name="url"><br><br>';
    
    foreach( $structureTemplate as $structure ){
        // echo '<pre>';
        // print_r($structure);
        
        $html .= (
            $structure->typeField != 'text'
            ?  htmlspecialchars( $structure->nameField ) .'<br><input name="'. $structure->nameField .'"><br><br>'
            : htmlspecialchars( $structure->nameField ) .'<br><textarea name="'. $structure->nameField .'">'. htmlspecialchars( $structure->nameField ) .'</textarea><br><br>'
        );


    }

    
    $html .= '<input type="submit"></form> ';

    echo $html;

    // echo '<pre>';
    // print_r($structureTemplate);

    // $template = $sql->query('SELECT `structureOfTemplate` FROM `template` WHERE nameOfTemplate="' . $_GET ['nameOfTemplate'] .'"')->fetch( PDO::FETCH_ASSOC );
    


}