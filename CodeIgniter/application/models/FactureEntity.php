<?php
class FactureEntity {

    private int $id;
    private string $date;
    private float $total;
    private int $userid;

    /**
	 * @return int
	 */
    public function getId(): int {
        return $this->id;
    }

    /**
	 * @return string
	 */
    public function getDate(): string {
        return $this->date;
    }

    /**
	 * @return float
	 */
    public function getTotal(): float {
        return $this->total;
    }

    /**
	 * @return int
	 */
    public function getUserId(): int {
        return $this->userid;
    }

    /**
	 * @param int $id
	 */
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    /**
	 * @param string $date
	 */
    public function setDate(string $date): void {
        $this->date = $date;
    }

    /**
	 * @param float $total
	 */
    public function setTotal(float $total): void {
        $this->total = $total;
    }

    /**
	 * @param int $userid
	 */
    public function setUserId(int $userid): void {
        $this->userid = $userid;
    }
}
?>
