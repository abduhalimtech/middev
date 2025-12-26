<?php

declare(strict_types=1);

final class WarehouseReport
{
    /** @var list<array{at: \DateTimeImmutable, sku: string, qty: int, price_cents: int, tags: list<string>}> */
    private array $events;

    private function __construct(array $events)
    {
        $this->events = $events;
    }

    public static function fromLines(array $lines): self
    {
        // TODO
        return new self([]);
    }

    /** @return list<array{at: \DateTimeImmutable, sku: string, qty: int, price_cents: int, tags: list<string>}> */
    public function events(): array
    {
        return $this->events;
    }

    public function totalRevenueCents(): int
    {
        // TODO
        return 0;
    }

    /** @return array<string,int> sku => revenue_cents */
    public function revenueBySkuCents(): array
    {
        // TODO
        return [];
    }

    /** @return list<string> */
    public function topSkusByQty(int $limit): array
    {
        // TODO
        return [];
    }

    public function dailyRevenueCents(string $day, string $timezone): int
    {
        // TODO
        return 0;
    }

    public function filterByTag(string $tag): self
    {
        // TODO
        return new self([]);
    }

    private static function normalizeSku(string $sku):string{
        $sku = strtolower(trim($sku));
        return preg_replace('/\s+/', '', $sku) ?? '';
    }

    private static function parseQty(string $raw): int{
        
    }
}
