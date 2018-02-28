<?php
  $errors = "";
  $db = mysqli_connect ('localhost', 'root','finish77', 'todo');
  if (isset($_POST['submit'])) {
      $task = $_POST['tasks'];
      if (empty($task)) {
         $errors = "veuillez mettre une tâche";
      }else {
      mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
      header ('location: index.php');
      }
 }

  if  (isset($_GET['del_task'])) {
      $id = $_GET['del_task'];
      mysqli_query($db, "DELETE FROM tasks WHERE id=$id");

}

  $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>


<!DOCTYPE html>
<html>
<head>
    <title>todo list PHP and MySQL</title>
    <link rel='stylesheet' type="text/css" href="style.css">
</head>
<body>
    <div class="heading">
          <h2>todo list php and MySQL</h2>
    </div>

    <form method="POST" action="index.php">



        <input type="text" name="tasks" class="task_input">
        <button type="submit" class"add_btn" name="submit">Rajouter tâches</button>

    </form>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Tâches</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
          <?php while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['ID']; ?>">X</a>
                </td>
          </tr>

        <?php } ?>

        </tbody>

    </table>

</body>
</html>
