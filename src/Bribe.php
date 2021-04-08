<?php

class Bribe
{
    private int $id;
    private string $name;
    private int $payment;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Bribe
     */
    public function setId(int $id): Bribe
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Bribe
     */
    public function setName(string $name): Bribe
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getPayment(): int
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     * @return Bribe
     */
    public function setPayment(int $payment): Bribe
    {
        $this->payment = $payment;
        return $this;
    }

}