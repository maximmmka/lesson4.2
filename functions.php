<?php
function create($pdo,$task){  
    if (!empty($_GET['description'])) {
        $stmt =  $pdo->prepare("INSERT INTO `tasks`( `description`, `date_added`, `is_done`) VALUES (?, NOW(), '0')");
        $stmt->bind_param('s', $task);
        $stmt->execute();
        $stmt->close();
        reload();
    }        
}

function delete($pdo,$id){
    if (!empty($_GET['action'])) {
        if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
            $stmt =  $pdo->prepare("DELETE FROM tasks WHERE id= ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            reload();
        }
    }
}

function done($pdo,$id){
    if (!empty($_GET['action'])) {

        if ($_GET['action'] == 'done' && !empty($_GET['id'])) {
            $stmt =  $pdo->prepare("UPDATE `tasks` SET `is_done`= 1 WHERE id= ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            reload();
        }
    }
}

function reload(){
    echo '<meta http-equiv="refresh" content="0.2;URL=/">';
}
?>
