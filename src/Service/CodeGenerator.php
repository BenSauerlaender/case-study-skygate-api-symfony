<?php

namespace App\Service;

class CodeGenerator
{
    public function getCode(int $length): string
    {
        $code = "";

        //add "length" times one digit between 1 and 9 to ret
        for ($i = 0; $i < $length; $i++) {
            $num = rand(1, 9);
            $code = $code . "{$num}";
        }

        return $code;
    }
}
