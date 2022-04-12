<?php
    require __DIR__."/vendor/autoload.php";
    require __DIR__."/User.php";

    use Symfony\Component\Validator\Constraints\Email;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Mapping\ClassMetadata;
    use Symfony\Component\Validator\Validation;

    class Comment
    {
        private User $user;
        private string $_message;

        public function __construct(User $user, string $message)
        {
            $this->user = $user;
            $this->message = $message;
        }

        public function getMessage()
        {
            return $this->message;
        }

        public function getUserTimeCreation()
        {
            return $this->user->getTimeCreation();
        }

        
    }