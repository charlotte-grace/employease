<?php

namespace App\Lib\ValueObjects;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class ValueObject extends Model implements ValueObjectInterface
{
    public const ORDER_BY_ORDER = 'order';

    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    /**
     * @param int $id
     * @return ValueObjectInterface
     */
    public static function getById(int $id): ValueObjectInterface
    {
        return static::query()
            ->where('id', '=', $id)
            ->limit(1)
            ->get()
            ->first() ?? new static();
    }

    /**
     * @param string $slug
     * @return ValueObjectInterface
     */
    public static function getBySlug(string $slug): ValueObjectInterface
    {
        return static::query()
            ->where('slug', '=', $slug)
            ->limit(1)
            ->get()
            ->first() ?? new static();
    }

    /**
     * @param array $slugs
     * @param string $orderBy
     * @return Collection
     */
    public static function getBySlugs(array $slugs, string $orderBy = self::ORDER_BY_ORDER): Collection
    {
        return static::query()
            ->whereIn('slug', $slugs)
            ->orderBy($orderBy)
            ->get();
    }

    /**
     * @param string $name
     * @return ValueObjectInterface
     */
    public static function getByName(string $name): ValueObjectInterface
    {
        return static::query()
            ->where('name', '=', $name)
            ->limit(1)
            ->get()
            ->first() ?? new static();
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getId(): int
    {
        return $this->id ?? throw new \Exception();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getSlug(): string
    {
        return $this->slug ?? throw new \Exception();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getName(): string
    {
        return $this->name ?? throw new \Exception();
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return (isset($this->order)) ? $this->order : 1;
    }

    /**
     * @param $slug
     * @return bool
     * @throws \Exception
     */
    public function matchSlug($slug): bool
    {
        return $this->getSlug() === $slug;
    }

    /**
     * @param ValueObjectInterface $valueObject
     * @return bool
     * @throws \Exception
     */
    public function sameAs(ValueObjectInterface $valueObject): bool
    {
        return $this->getSlug() === $valueObject->getSlug();
    }

    /**
     * @param Collection $valueObjects
     * @return bool
     * @throws \Exception
     */
    public function sameAsAny(Collection $valueObjects): bool
    {
        foreach ($valueObjects as $valueObject) {
            if ($this->sameAs($valueObject)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getForFormSelectBySlug(): array
    {
        return self::query()
            ->where('is_active', '=', true)
            ->orderBy('order')
            ->pluck('name', 'slug')
            ->toArray();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
