<?php
    require __DIR__."/vendor/autoload.php";

    require_once './Comment.php';
    require_once './User.php';

    echo "Hello from PHP <br>";
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Validation;

    function UserValidation(User $user)
    {
        $validator = Validation::createValidatorBuilder()->addMethodMapping('loadValidatorMetadata')
        ->getValidator();
        $violations = $validator->validate($user);

        echo "Valodation user:<br>";

        if (count($violations) > 0) {
            foreach ($violations as $violation) {
                echo $violation->getMessage()."<br>";
            }
        }
        else
        {
            echo "User is valid<br>";
        }
        echo $user->GetTimeCreation(). "<br>";
    }   

    //Данные пользователя валидны
    $user1 = new User(1 ,"Anton", "A.t@gmail.com", "c4cdls");
    //Имя слишком длинное, пароль слишком короткий
    $user2 = new User(1 ,"Antondldldldldldldldldlldldldldld", "A.t@gmail.com", "c4");
    //Имя слишком длинное, пароль слишком короткий, почта введена неправильно
    $user3 = new User(1 ,"Antondldldldldldldldldlldldldldld", "A", "c4");

    UserValidation($user1);
    UserValidation($user2);
    UserValidation($user3);

    $comments = array();
    for ($i = 0; $i < 5; $i++) {
        $u = new User($i, "UserU", "A.t@gmail.com", "c4cdls");
        $commetns[$i] = new Comment($u, "comment $i");
    }

    $date = $_POST['date'];

    foreach ($commetns as $c) {
        $commetn_user_date = $c->GetUserTimeCreation();
        
        if (strtotime($commetn_user_date) > strtotime($date))
        {
            echo $c->GetMessage() . ' user time:' . $c->GetUserTimeCreation() . '<br>';
        }
        
    }
    