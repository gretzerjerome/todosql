<?php
	$errors = ""; //<=== message d'erreur
  //connection à MySQL
  $db = mysqli_connect ('localhost', 'root','finish77', 'todo');
  //postage d'une tâche
  if (isset($_POST['submit'])) {
      $task = $_POST['tasks'];
      // suite du message d'erreur
      if (empty($task)) {
         $errors = "Veuillez mettre une tâche";
      }else {
      mysqli_query($db, "INSERT INTO tasks (task, valeur) VALUES ('$task', '0')") ;
      header ('location: index.php');
      }
 }

// pour modifier et passer une tâche de "à faire" à "archive"
  if  (isset($_GET['changement'])) {
      mysqli_query($db, "UPDATE tasks SET valeur='1' WHERE valeur='0'");

			}

			// pour supprimer la tâche
	if (isset($_GET['retourenvoyeur'])) {
		 $id = $_GET['retourenvoyeur'];
		 mysqli_query($db, "DELETE FROM tasks WHERE id=$id");

}

  $tasks_false = mysqli_query($db, 'SELECT * FROM tasks WHERE valeur="0"');
  $tasks_true = mysqli_query($db, 'SELECT * FROM tasks WHERE valeur="1"');
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
      <?php if (isset($errors)) { ?>
      <p><?php echo $errors; ?></p>
      <?php } ?>



        <input type="text" name="tasks" class="task_input">
        <button type="submit" class"add_btn" name="submit">Rajouter tâches</button>

    </form>

    <table>
        <thead>
            <tr>
              <h2>À faire</h2>
                <th>N°</th>
                <th>Tâches</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
          <?php $i = 1; while ($row = mysqli_fetch_array($tasks_false)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="index.php?changement=<?php echo $row['ID']; ?>">X</a>
                </td>
          </tr>

        <?php $i++; } ?>

        </tbody>

    </table>

    <table>

      <thead>
            <tr>
              <h2>Archives</h2>
                <th>N°</th>
                <th>Tâches</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
          <?php $i = 1; while ($row = mysqli_fetch_array($tasks_true)) { ?>
          <tr>
              <td><?php echo $i; ?></td>
              <td class="task"><?php echo $row['task']; ?></td>
              <td class="delete">
                  <a href="index.php?changement=<?php echo $row['ID']; ?>">X</a>
              </td>
        </tr>
      <?php $i++; } ?>

</body>
</html>
