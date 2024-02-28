<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Checklist\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Checklist\Models;

/**
 * Checklist class.
 *
 * @package Modules\Checklist\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class ChecklistTemplate
{
    /**
     * Account ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    public string $name = '';

    public string $description = '';

    public int $repeat = 0;

    public string $interval = '';

    public \DateTime $start;

    public ?\DateTime $end = null;

    /**
     * @var \Modules\Tasks\Models\Task[]
     */
    public array $tasks = [];

    public function __construct()
    {
        $this->start = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
