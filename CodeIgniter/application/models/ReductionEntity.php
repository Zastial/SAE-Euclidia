<?php
class ReductionEntity{
    private string $code;
    private int $reduction;

    public function getCode(){
        return $this->code;
    }

    public function getReduction(){
        return $this->reduction;
    }

    public function setCode(string $code){
        $this->code = $code;
    }

    public function setReduction(int $reduction){
        $this->reduction = $reduction;
    }
}
?>