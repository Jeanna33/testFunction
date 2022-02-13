<?php

class convertFunction
{
    /*
     alphabet - Алфавит или используемое перечисление
     P - максимальный размер получаемой строки, порядок
     divisibleString - делимая строка
    */
    public static function convertToLetter($num=1){
        try {
            if($num<1 || gettype($num)!='integer')
                throw new Exception("Only positive integer numbers");
            $alphabet = '';
            $result = '';
            $P = 5;
            $divisibleString = $num;
            foreach (range('A', 'Z') as $letter) {
                $alphabet .= $letter;
            }
            function pushNumber(&$alphabet,$P,$divisibleString,$num)
            {
                $res='';
                $maxSizeAlphabet=strlen($alphabet);
                for ($i = $P - 1; $i > -1; $i--) {
                    $limit = pow(10, $i);
                    $numLetter = intval($divisibleString / $limit);
                    if ($numLetter >= $maxSizeAlphabet) {
                        $res .= $alphabet[$maxSizeAlphabet - 1];
                    } else {
                        $res .= $alphabet[$numLetter];
                    }
                    $divisibleString = $divisibleString - 26 * $limit;
                    if ($divisibleString < 0) break;
                }
                if (strlen(strval($num)) < $P - 1) {
                    $res .= str_repeat("0", (($P - 1) - strlen(strval($num))));
                    $res .= $num;
                } else if (strlen($num) <= $P) {
                    $res .= substr(strval($num), strlen($res));
                }
                return $res;
            }
            $result=pushNumber($alphabet,$P,$divisibleString,$num);
            if($num>1){
                try {
                    if(pushNumber($alphabet,$P,$num-1,$num-1)===$result)
                        throw new Exception('Out of range');
                }
                catch (Exception $e){
                    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
                }
            }
            return $result;
        }
        catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }
    }
}