<?php

$calc = new Calc();
$calc->calculate();

class Calc 
{
    //Properties
    private $operator;
    private $num;
    private const OPERATORS = array("+", "-", "*", "/", "%", "!", "**", "=");


    //Setters
    public function setOperator() 
    {
        do {
            $this->operator = readline("Enter an operator : ");
            if(in_array($this->operator, self::OPERATORS)) {
                break;
            }
            echo "Invalid operation\n";
        } while(true);
    }

    public function setNum($loop) {
        if($this->operator !== "!" && $this->operator !== "=") {
            do {
            $this->num = readline("Enter " . $loop + 1 . " number : ");
            if(is_numeric($this->num)) {
                break;
            }
            echo "Invalid number\n";
            } while(true);
        }
    }

    //Arithmetic operations
    private function addition($total) {
        return $total + $this->num;
    }

    private function subtraction($total) {
        if($this->num == 0) {
            echo "Can't divide by 0\n";
        } else {
            return $total - $this->num;
        }
    }

    private function multiplication($total) {
        return $total * $this->num;
    }

    private function division($total) {
        return $total / $this->num;
    }

    private function modulo($total) {
        return $total % $this->num;
    }

    private function factorial($total) {
        $temp = $total - 1;
        for ($j = 0; $j < $temp; $j++) {
            $total *= $j + 1;
        }

        return $total;
    }

    private function power($total) {
        $temp = $total;
        for ($j = 1; $j < $this->num; $j++) {
            $total *= $temp;
        }

        return $total;
    }

    private function total() 
    {
        do {
            $total = readline("Enter 1 number : ");
            if(is_numeric($total)) {
                break;
            }
            echo "Invalid number\n";
        } while(true);
        return $total;
    }
    
    //Main function
    public function calculate()
    {
        $total = $this->total();
        $loop = 1;
        do {
            $this->setOperator();
            $this->setNum($loop);
        
            switch($this->operator) {
                case self::OPERATORS[0]: 
                    $total = $this->addition($total);
                    break;
                case self::OPERATORS[1]:
                    $total = $this->subtraction($total);
                    break;
                case self::OPERATORS[2]: 
                    $total = $this->multiplication($total);
                    break;
                case self::OPERATORS[3]: 
                    $total = $this->division($total);
                    break;
                case self::OPERATORS[4]: 
                    $total = $this->modulo($total);
                    break;
                case self::OPERATORS[5]:
                    $total = $this->factorial($total);
                    break;
                case self::OPERATORS[6]:
                    $total = $this->power($total);
                    break;
            }
            if ($this->operator != self::OPERATORS[5]) {  
                $loop++;
            }
        } while($this->operator !== self::OPERATORS[7]);

        echo $total . "\n";
    }
}
