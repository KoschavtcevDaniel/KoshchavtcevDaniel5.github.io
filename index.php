<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
session_start();
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);
    // Выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
    // Если в куках есть пароль, то выводим сообщение.
    if (!empty($_COOKIE['pass'])) {
      $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass']));
    }
    setcookie('name_value', '', 100000);
    setcookie('email_value', '', 100000);
    setcookie('year_value', '', 100000);
    setcookie('sex_value', '', 100000);
    setcookie('limbs_value', '', 100000);
    setcookie('biography_value', '', 100000);
    setcookie('ab_in_value', '', 100000);
    setcookie('ab_t_value', '', 100000);
    setcookie('ab_l_value', '', 100000);
    setcookie('ab_v_value', '', 100000);
    setcookie('check_value', '', 100000);
  }
  

  // Складываем признак ошибок в массив.
  $errors = array();
  $error=FALSE;
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['sex'] = !empty($_COOKIE['sex_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['abilities'] = !empty($_COOKIE['ability_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['check1'] = !empty($_COOKIE['check_error']);

  // TODO: аналогично все поля.

  // Выдаем сообщения об ошибках.
  if ($errors['fio']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('fio_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  if ($errors['email']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('email_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните e-mail.</div>';
  }
  if ($errors['year']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('year_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Неправильный год.</div>';
  }
  if ($errors['sex']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('sex_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Неправильный sex.</div>';
  }
  if ($errors['limbs']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('limbs_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Неправильные данные.</div>';
  }
  if ($errors['abilities']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('ability_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Выберите способность.</div>';
  }
  if ($errors['biography']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('biography_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните биографию.</div>';
  }
  if ($errors['check1']) {
    setcookie('check_error', '', 100000);
    $messages[] = '<div class="error">Вы должны быть согласны дать свои данные.</div>';
  }
  // TODO: тут выдать сообщения об ошибках в других полях.

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : strip_tags($_COOKIE['fio_value']);
  $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
  $values['year'] = empty($_COOKIE['year_value']) ? 0 : strip_tags($_COOKIE['year_value']);
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : strip_tags($_COOKIE['sex_value']);
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : strip_tags($_COOKIE['limbs_value']);
  $values['ab_in'] = empty($_COOKIE['ab_in_value']) ? 0 : strip_tags($_COOKIE['ab_in_value']);
  $values['ab_t'] = empty($_COOKIE['ab_t_value']) ? 0 : strip_tags($_COOKIE['ab_t_value']);
  $values['ab_l'] = empty($_COOKIE['ab_l_value']) ? 0 : strip_tags($_COOKIE['ab_l_value']);
  $values['ab_v'] = empty($_COOKIE['ab_v_value']) ? 0 : strip_tags($_COOKIE['ab_v_value']);
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : strip_tags($_COOKIE['biography_value']);
  $values['check1'] = empty($_COOKIE['check_value']) ? 0 : strip_tags($_COOKIE['check_value']);


  if (!$errors && !empty($_COOKIE[session_name()]) &&
  session_start() && !empty($_SESSION['login'])) {
  // TODO: загрузить данные пользователя из БД  
  $user = 'u52997';
$pass = '4390881';
$db = new PDO('mysql:host=localhost;dbname=u52997', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
  $get=$db->prepare("SELECT * FROM app WHERE id=?");
  $get->bindParam(1,$_SESSION['uid']);
  $get->execute();
  $info=$get->fetchALL();
  $values['fio']=$inf[0]['fio'];
  $values['email']=$inf[0]['email'];
  $values['year']=$inf[0]['year'];
  $values['sex']=$inf[0]['sex'];
  $values['limbs']=$inf[0]['limbs'];
  $values['biography']=$inf[0]['biography'];

  $get2=$db->prepare("SELECT ability FROM app_abil WHERE application_id=?");
  $get2->bindParam(1,$_SESSION['uid']);
  $get2->execute();
  $inf2=$get2->fetchALL();
  for($i=0;$i<count($inf2);$i++){
    if($inf2[$i]['ability']=='ab_in'){
      $values['ab_in']=1;
    }
    if($inf2[$i]['ability']=='ab_t'){
      $values['ab_t']=1;
    }
    if($inf2[$i]['ability']=='ab_l'){
      $values['ab_l']=1;
    }
    if($inf2[$i]['ability']=='ab_v'){
      $values['ab_v']=1;
    }
  }
}
catch(PDOException $e){
  print('Error: '.$e->getMessage());
  exit();
}
  // и заполнить переменную $values,
  // предварительно санитизовав.
  printf('Вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
  }

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  if(!empty($_POST['logout'])){
    session_destroy();
    header('Location: index.php');
  }
  else{
    $name = $_POST['fio'];
    $email = $_POST['email'];
    $year = $_POST['year'];
    $sex=$_POST['sex'];
    $limbs=$_POST['limbs'];
    $ability=$_POST['abilities'];
    $biography=$_POST['biography'];
    if(empty($_SESSION['login'])){
      $check=$_POST['check1'];
    }

  $bioregex = "/^\s*\w+[\w\s\.,-]*$/";
  $nameregex = "/^\w+[\w\s-]*$/";
  $mailregex = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";

  $errors = FALSE;
  if (empty($_POST['fio']) || (!preg_match($nameregex,$_POST['fio'])) ) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
    setcookie('fio_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('fio_value', $_POST['fio'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('fio_error', '', 100000);
  }
  
  if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !preg_match($mailregex,$_POST['email'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    setcookie('email_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('email_value', $_POST['email'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('email_error', '', 100000);
  }

  if ($_POST['year']=='Не выбран') {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    setcookie('year_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('year_value', $_POST['year'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('year_error', '', 100000);
  }

  if (!isset($_POST['sex'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('sex_error', '1', time() + 24 * 60 * 60);
    setcookie('sex_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('sex_value', $_POST['sex'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('sex_error', '', 100000);
  }

  if (!isset($_POST['limbs'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('limbs_error', '1', time() + 24 * 60 * 60);
    setcookie('limbs_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('limbs_value', $_POST['limbs'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('limbs_error', '', 100000);
  }

  if (!isset($_POST['abilities'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('ability_error', '1', time() + 24 * 60 * 60);
    setcookie('ab_in_value', '', 100000);
    setcookie('ab_t_value', '', 100000);
    setcookie('ab_l_value', '', 100000);
    setcookie('ab_v_value', '', 100000);
    $errors = TRUE;
  }
  else {
    $ability=$_POST['abilities'];
    $abil=array(
      "ab_in_value"=>0,
      "ab_t_value"=>0,
      "ab_l_value"=>0,
      "ab_v_value"=>0,
    );
  foreach($ability as $ab){
    if($ab =='ab_in'){setcookie('ab_in_value', 1, time() + 12 * 30 * 24 * 60 * 60); $abil['ab_in_value']=1;} 
    if($ab =='ab_t'){setcookie('ab_t_value', 1, time() + 12*30 * 24 * 60 * 60);$abil['ab_t_value']=1;} 
    if($ab =='ab_l'){setcookie('ab_l_value', 1, time() + 12*30 * 24 * 60 * 60);$abil['ab_l_value']=1;}
    if($ab =='ab_v'){setcookie('ab_v_value', 1, time() + 12*30 * 24 * 60 * 60);$abil['ab_v_value']=1;} 
    }
  foreach($abil as $cons=>$val){
    if($val==0){
      setcookie($cons,'',100000);
    }
  }
    // Сохраняем ранее введенное в форму значение на месяц.
  }

  if (empty($_POST['biography']) || !preg_match($bioregex,$_POST['biography'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('biography_error', '1', time() + 24 * 60 * 60);
    setcookie('biography_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('biography_value', $_POST['biography'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('biography_error', '', 100000);
  }
  if(!isset($_POST['check1'])){
    setcookie('check_error','1',time()+  24 * 60 * 60);
    setcookie('check_value', '', 100000);
    $errors=TRUE;
  }
  else{
    setcookie('check_value', TRUE,time()+ 12 * 30 * 24 * 60 * 60);
    setcookie('check_error','',100000);
  }
  if(empty($_SESSION['login'])){
    if(!isset($check)){
      setcookie('check_error','1',time()+ 24*60*60);
      setcookie('check_value', '', 100000);
      $errors=TRUE;
    }
    else{
      setcookie('check_value',TRUE,time()+ 60*60);
      setcookie('check_error','',100000);
    }
  }
// *************
// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
// Сохранить в Cookie признаки ошибок и значения полей.
// *************

  if ($errors) {
    setcookie('save','',100000);
    header('Location: login.php');
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('fio_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('sex_error', '', 100000);
    setcookie('limbs_error', '', 100000);
    setcookie('ability_error', '', 100000);
    setcookie('biography_error', '', 100000);
    setcookie('check_error', '', 100000);
    
  }

  $user = 'u52997';
  $pass = '4390881';
  $db = new PDO('mysql:host=localhost;dbname=u52997', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  
  if (!empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
        $id=$_SESSION['uid'];
        $upd=$db->prepare("INSERT INTO app SET name = ?, email = ?, year = ?, sex = ?, limbs = ?, biography = ? WHERE id =:id ");
        $stmt -> execute([$_POST['fio'], $_POST['email'], $_POST['year'], $_POST['sex'],$_POST['limbs'], $_POST['biography']]);

        foreach($cols as $k=>&$v){
          $upd->bindParam($k,$v);
        }
        $upd->bindParam(':id',$id);
        $upd->execute();
        $del=$db->prepare("DELETE FROM app_abil WHERE aplication_id=?");
        $del->execute(array($id));
        $upd1=$db->prepare("INSERT INTO app_abil SET ability=:ability, aplication_id=:id");
        $upd1->bindParam(':id',$id);
        foreach($ability as $abl){
          $upd1->bindParam(':ability',$abl);
          $upd1->execute();
        }
    // TODO: перезаписать данные в БД новыми данными, update()
    // кроме логина и пароля.
  }
  else {
    if(!$errors){
      $login = 'u'.substr(uniqid().uniqid(),-5);
      $pass = substr(md5(uniqid().uniqid()),rand(0, 5),10);
      $pass_hash = password_hash($pass,PASSWORD_DEFAULT);
      setcookie('login', $login);
      setcookie('pass', $pass);
      try {
        $stmt = $db->prepare("INSERT INTO app SET name = ?, email = ?, year = ?, sex = ?, limbs = ?, biography = ?");
        $stmt -> execute([$_POST['fio'], $_POST['email'], $_POST['year'], $_POST['sex'],$_POST['limbs'], $_POST['biography']]);
        
        $usr = $db->prepare("INSERT INTO user_app SET uid = ?, login = ?, password = ?");
        $usr->bindParam(1,$id);
        $usr->bindParam(2,$login);
        $usr->bindParam(3,$pass_hash);
        $usr->execute();

        $application_id = $db->lastInsertId();
        $application_ability = $db->prepare("INSERT INTO application_ability SET aplication_id = ?, ability = ?");
        foreach($_POST["abilities"] as $ability){
        $application_ability -> execute([$application_id, $ability]);
        print($ability);
        }
      }
       catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        exit();
      }
    }
  }
if(!$errors){
  setcookie('save', '1');
}
  // Делаем перенаправление.
  header('Location: ./');
}
}

