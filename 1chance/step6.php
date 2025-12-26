<?php
final class BankAccount
{
    private int $balance = 0;

    public function deposit(int $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException('Deposit must be > 0');
        }

        $this->balance += $amount;
    }

    public function withdraw(int $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException('Withdraw must be > 0');
        }

        if ($amount > $this->balance) {
            throw new InvalidArgumentException('Insufficient funds');
        }

        $this->balance -= $amount;
    }

    public function balance(): int
    {
        return $this->balance;
    }
}
