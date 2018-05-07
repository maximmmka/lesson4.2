<?php 
  require 'connect.php';
  require 'functions.php';
	
  $data = $pdo->query('SELECT * FROM tasks');

  if(isset($_GET['description']) && !empty($_GET['description'])){
    $description = $_GET['description'];
  } 

  if(isset($_GET['action']) && !empty($_GET['action'])){
    $action = ($_GET['action']);
  } 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>cписок дел</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <h1 class="headers">Список дел на сегодня</h1>

  <form action="">         
    <input class="input" type="text" name="description" placeholder="Описание задачи">
    <input class="send" type="submit" name="save" value="Добавить">
  </form>

  <table class="table">
    <thead class="headers">
      <tr>
        <td class="tableHeaders"> Описание задачи </td>
        <td class="tableHeaders"> Дата добавления </td>
        <td class="tableHeaders"> Статус </td>
        <td class="tableHeaders"> Опции </td>
      </tr>
    </thead>

    <tbody>
      <?php
        foreach ($data as $tasks) {
          if($tasks['is_done']==0){
            $isDone = '<span class=inProgress> В процессе </span>';             
          }else{
            if($tasks['is_done']==1){
              $isDone = '<span class=made> Выполнено </span>';
            }
          }
          
        	if(isset($description) && $description==$tasks['description']){
          	$value = 1;
        	}
	          echo
	          '<tr>
	            <td class=slot>'.$tasks['description'].'</td>
	            <td class=slot>'.$tasks['date_added'].'</td>
	            <td class=slot>'.$isDone.'</td>
	            <td class=slot>
	              <a class="links" href="index.php?action=done&id='.$tasks['id'].'"><span class="made"> Выполнить </span></a>
	              <a class="links delite" href=index.php?action=delete&id='.$tasks['id'].'"> Удалить </a>
	            </td>
	          </tr>';
	}

          if(isset($description) && $description!=$tasks['description'] && !empty($description)){
            create($pdo,$description);
          }

          if(isset($action) && ($action=='delete')){
            delete($pdo,($_GET['id']));
          }
                
          if(isset($action) && $action=='done'){
            done($pdo,($_GET['id']));
          }                
      ?>
    </tbody>
  </table>
</body>
</html>
