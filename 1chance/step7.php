<?php

declare(strict_types=1);

interface IdGenerator
{
    public function nextId(): int;
}

final class SequenceIdGenerator{
    public function __construct(private int $next)
    {
        if($next <=0){
            throw new \Exception('wrong int');
        }
    }

    public function nextId():int{
        return $this->next++;
    }
}

final class UserRegister{
    public function __construct(private IdGenerator $ids){}

    public function register(string $rawEmail):array {
        $email = strtolower(trim($rawEmail));
        if(filter_var($email, FILTER_VALIDATE_EMAIL) ===false){
            throw new InvalidArgumentException("Invalid email");
            
        }

        return [
            'id' => $this->ids->nextId(),
            'email' => $email,
        ];
    }
}


// $gen = new SequenceIdGenerator(100);
// $reg = new UserRegistrar($gen);

// print_r($reg->register("  Ali@EXAMPLE.com "));
// // ['id'=>100, 'email'=>'ali@example.com']

// print_r($reg->register("vali@a.io"));
// // ['id'=>101, 'email'=>'vali@a.io']
