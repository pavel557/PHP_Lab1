<?php
    require __DIR__."/vendor/autoload.php";

    use Symfony\Component\Validator\Constraints\Email;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Mapping\ClassMetadata;
    use Symfony\Component\Validator\Validation;

    class User
    {
        private int $id;
        private string $name;
        private string $email;
        private string $password;
        private string $timeCreation;

        public function __construct(int $id, string $name, string $email, string $password)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->timeCreation = date("F j, Y, g:i a");
        }

        public function getTimeCreation()
        {
            return $this->timeCreation;
        }

        public static function loadValidatorMetadata(ClassMetadata $metadata)
        {
            $metadata->addPropertyConstraint('id', new NotBlank());
            $metadata->addPropertyConstraint('name', new Length(['min' => 3, 'max' => 20]));
            $metadata->addPropertyConstraint('email', new Length(['min' => 5, 'max' => 63]));
            $metadata->addPropertyConstraint('email', new Email());
            $metadata->addPropertyConstraint('password', new Length(['min' => 4, 'max' => 31]));
        }
    }