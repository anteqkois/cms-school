<?php

session_start(); unset( $_SESSION['kom'] );

$html = '

<meta charset="utf-8">

<style>
	table { width: 50%; border: 1px solid black; border-collapse: collapse;}
	th { vertical-align: top; border: 1px solid black;  }
  td { text-align: center;  border: 1px solid black;}
	table input, textarea { width: 100%; }
	textarea { height: 200px; }
</style>

';

require_once '../polacz_z_baza.php';
//pobieranie wstawek dodać
// $columns = $sql->query( 'desc podstrony' /* lub 'show columns from podstrony' */ )->fetchAll( PDO::FETCH_NUM );

# echo '<pre>'; var_dump( $column_types ); exit;

echo $html;
?>
<h1>Dodawanie szablonu</h1>

<form action="addTemplateAction.php" method="post" onsubmit="return submitForm();">
  <input type="hidden" id="data" name="data" value="">
  Nazwa szablonu: <input type="text" name="name" id="name"><br><br>
  Nazwa pola: <input type="text" id="newName"> typ:
    <select id="typeOption">
      <option value="textarea">textarea</option>
      <option value="text">text</option>
    </select>
    <button id="add">+</button>
	
<br><br>
<table>
  <caption>Pola szablonu</caption>
  <thead>
    <tr>
      <th>Tytuł pola</th>
      <th>Typ pola</th>
    </tr>
  </thead>
  <tbody id="fields">

  </tbody> 
</table><br>
Kod PHP:<br>
<textarea name="template" id="template" ></textarea><br>
  <input type="submit" value="zapisz" id="submit">
</form>

<script>

  const htmlToTemplate = `
<!DOCTYPE html>
  <html lang="pl">
      <head>
          <meta charset="utf-8">
          <title></title>
          <style>
          </style>
      </head>
      <body>
      </body>
  </html>`;

  document.getElementById('template').value = htmlToTemplate;
  
  let data = [];
  
  const submitForm = ()=>{
    dataToSend = JSON.stringify(data)
    document.getElementById("data").value = dataToSend;
  }
  
  const addButton = document.getElementById('add');
  addButton.addEventListener('click', (e)=>{
    e.preventDefault();

    const newField = document.createElement('tr');
    const nameTd = document.createElement('td');
    const typeTd = document.createElement('td');
    name = document.getElementById('newName').value;
    type = document.getElementById('typeOption').value;
    nameTd.innerHTML = name;
    typeTd.innerHTML = type;
    newField.appendChild(nameTd);
    newField.appendChild(typeTd);
    document.getElementById('fields').appendChild(newField);

    data = [...data, {nameField: name, typeField: type}]
  })
    
</script>