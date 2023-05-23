<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <title>Form</title>
</head>
<body>
  <?php
  if (!empty($messages['allok'])) {
    if (empty($_SESSION['login']))
      print('<div id="header"><a href=login.php>Войти</a></div>');
    print($messages['allok']);
  }
  if (!empty($messages['login'])) {
    print($messages['login']);
  }
  ?>
  <form action="" method="POST">
    <div class="form-head">
        <h1>Форма</h1>
    </div>
    <div class="form-content">
      <div class="form-item">
        <p <?php if ($errors['name1'] || $errors['name2']) {print 'class="error"';} ?>>Имя:</p>
        <input class="line" name="name" value="<?php echo htmlspecialchars($values['name']); ?>" />
        <?php if ($errors['name1']) {print $messages['name1'];} else if ($errors['name2']) {print $messages['name2'];};?>
      </div>
      <div class="form-item">
        <p <?php if ($errors['email1'] || $errors['email2']) {print 'class="error"';} ?>>Email:</p>
        <input class="line" name="email" value="<?php print htmlspecialchars($values['email']); ?>" />
        <?php if ($errors['email1']) {print $messages['email1'];} else if ($errors['email2']) {print $messages['email2'];}?>
      </div>
      <div class="form-item">
        <div class="date">
          <span <?php if ($errors['year1'] || $errors['year2']) {print 'class="error"';} ?>>День рождения</span>
          <select name="year">
            <?php 
              for ($i = 2023; $i >= 1922; $i--) {
                if ($i == $values['year']) {
                  printf('<option selected value="%d">%d год</option>', $i, $i);
                } else {
                printf('<option value="%d">%d год</option>', $i, $i);
                }
              }
            ?>
          </select>
        </div>
        <?php if ($errors['year1']) {print $messages['year1'];} else if ($errors['year2']) {print $messages['year2'];}?>  
      </div>
      <div class="form-item">
        <p <?php if ($errors['gender1'] || $errors['gender2']) {print 'class="error"';} ?>>Пол:</p>
        <?php if ($errors['gender1']) {print $messages['gender1'];} else if ($errors['gender2']) {print $messages['gender2'];}?>  
        <ul>
          <li>
            <input type="radio" id="radioMale" name="gender" value="male" <?php if ($values['gender'] == 'male') {print 'checked';} ?>>
            <label for="radioMale">Мужчина</label>
          </li>
          <li>
            <input type="radio" id="radioFemale" name="gender" value="female" <?php if ($values['gender'] == 'female') {print 'checked';} ?>>
            <label for="radioFemale">Женщина</label>
          </li>
        </ul>
      </div>
      <div>
        <p <?php if ($errors['limbs1'] || $errors['limbs2']) {print 'class="error"';} ?>>Кол-во конечностей:</p>
        <?php if ($errors['limbs1']) {print $messages['limbs1'];} else if ($errors['limbs2']) {print $messages['limbs2'];}?>
        <ul>
          <li>
            <input type="radio" id="radio2" name="limbs" value="2" <?php if ($values['limbs'] == '2') {print 'checked';} ?>>
            <label for="radio2">2</label>
            <input type="radio" id="radio4" name="limbs" value="3" <?php if ($values['limbs'] == '3') {print 'checked';} ?>>
            <label for="radio4">3</label>
            <input type="radio" id="radio8" name="limbs" value="4" <?php if ($values['limbs'] == '4') {print 'checked';} ?>>
            <label for="radio8">4</label>
          </li>
        </ul>
      </div>
      <div class="form-item">
        <p <?php if ($errors['abilities1'] || $errors['abilities2']) {print 'class="error"';} ?>>Выберите сверхспособность:</p>
        <?php if ($errors['abilities1']) {print $messages['abilities1'];} else if ($errors['abilities2']) {print $messages['abilities2'];}?>
        <ul>
          <li>
            <input type="checkbox" id="god" name="abilities[]" value=1 <?php if (isset($values['abilities']) && !empty($values['abilities']) && in_array(1, unserialize($values['abilities']))) {print 'checked';}?>>
            <label for="god">бессмертие</label>
          </li>
          <li>
            <input type="checkbox" id="noclip" name="abilities[]" value=2 <?php if (isset($values['abilities']) && !empty($values['abilities']) && in_array(2, unserialize($values['abilities']))) {print 'checked';}?>>
            <label for="noclip">прохождение сквозь стены</label>
          </li>
          <li>
            <input type="checkbox" id="levitation" name="abilities[]" value=3 <?php if (isset($values['abilities']) && !empty($values['abilities']) && in_array(3, unserialize($values['abilities']))) {print 'checked';}?>>
            <label for="levitation">левитация</label>
          </li>
        </ul> 
      </div>
      <div class="form-item">
        <p class="big-text <?php if ($errors['biography1'] || $errors['biography2']) {print 'error';} ?>">Биография:</p>
        <?php if ($errors['biography1']) {print $messages['biography1'];} else if ($errors['biography2']) {print $messages['biography2'];}?>
        <textarea name="biography" cols=24 rows=4 maxlength=128 spellcheck="false"><?php if (!empty($values['biography'])) {print htmlspecialchars($values['biography']);} ?></textarea>
      </div>
    </div>  
    <div class="send">
      <div class="contract">
        <input type="checkbox" id="checkboxContract" name="checkboxContract" <?php if ($values['checkboxContract'] == '1') {print 'checked';} ?>>
        <label for="checkboxContract" <?php if ($errors['checkboxContract']) {print 'class="error"';} ?>>Ознакомлен с контрактом.</label>
        <?php if ($errors['checkboxContract']) {print $messages['checkboxContract'];} ?>
      </div>
      <input class="btn" type="submit" name="submit" value="send" />
    </div>
    <?php if (!empty($_SESSION['login'])) {echo '<input type="hidden" name="token" value="' . $_SESSION["token"] . '">'; } ?>
  </form>
</body> 
</html>
