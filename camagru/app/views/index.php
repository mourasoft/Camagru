
<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT. "/views/inc/navbar.php"?>

<!-- <link rel="stylesheet" href="<?= URLROOT?>/css/style.css"> -->
<div class="container">

    <div class="form">
      <div class="field">
        <h1>SIGN IN</h1>
        <p>LOG IN TO YOUR ACCOUNT TO CONTINUE.</p>
        <label class="label">Name</label>
        <div class="control">
          <input class="input" type="text" placeholder="Text input">
        </div>
      </div>
      <div class="field">
        <label class="label">Username</label>
        <div class="control has-icons-left has-icons-right">
          <input class="input is-success" type="text" placeholder="Text input" value="bulma">
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
          <span class="icon is-small is-right">
            <i class="fas fa-check"></i>
          </span>
        </div>
        <p class="help is-success">This username is available</p>
      </div>
    </div>
  </div>
<?php require_once APPROOT . "/views/inc/footer.php";?>
