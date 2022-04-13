<?php
    require __DIR__."/vendor/autoload.php";

    require_once './Comment.php';
    require_once './User.php';

    echo "Hello from PHP <br>";
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Validation;

    function userValidation(User $user)
    {
        $validator = Validation::createValidatorBuilder()->addMethodMapping('loadValidatorMetadata')->getValidator();
        $violations = $validator->validate($user);

        echo "Valodation user:<br>";

        if (count($violations) > 0) 
        {
            foreach ($violations as $violation) 
            {
                echo $violation->getMessage()."<br>";
            }
        }
        else
        {
            echo "User is valid<br>";
        }
        echo $user->getTimeCreation(). "<br>";
    }   

    //Данные пользователя валидны
    $user1 = new User(1 ,"Anton", "A.t@gmail.com", "c4cdls");
    //Имя слишком длинное, пароль слишком короткий
    $user2 = new User(1 ,"Antondldldldldldldldldlldldldldld", "A.t@gmail.com", "c4");
    //Имя слишком длинное, пароль слишком короткий, почта введена неправильно
    $user3 = new User(1 ,"Antondldldldldldldldldlldldldldld", "A", "c4");

    userValidation($user1);
    userValidation($user2);
    userValidation($user3);

    $comments = array();
    for ($i = 0; $i < 5; $i++) 
    {
        $u = new User($i, "UserU", "A.t@gmail.com", "c4cdls");
        $commetns[$i] = new Comment($u, "comment $i");
    }

    $date = $_POST['date'];

    foreach ($commetns as $c) 
    {
        $commentDate = $c->getUserTimeCreation();
        
        if (strtotime($commentDate) > strtotime($date))
        {
            echo $c->getMessage() . ' user time:' . $c->getUserTimeCreation() . '<br>';
        }
    }
    