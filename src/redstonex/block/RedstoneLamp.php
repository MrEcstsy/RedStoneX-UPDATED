<?php

declare(strict_types=1);

namespace redstonex\block;

use pocketmine\math\Vector3;
use redstonex\RedstoneX;

/**
 * Class RedstoneLamp
 * @package redstonex\block
 */
class RedstoneLamp extends RedstoneLampUnlit {

    /**
     * @var int $id
     */
    protected $id = RedstoneX::REDSTONE_LAMP_ACTIVE;

    /**
     * RedstoneLamp constructor.
     * @param int $meta
     */
    public function __construct($meta = 0) {
        parent::__construct($meta);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Redstone Lamp";
    }

    /**
     * @param int $type
     * @return int
     */
    public function onUpdate(int $type) {
        $this->checkDeactivate();
        return $type;
    }

    public function checkDeactivate() {
        for($x = $this->getX() - 1; $x <= $this->getX() + 1; $x++) {
            for($y = $this->getY() - 1; $y <= $this->getY() + 1; $y++) {
                if($x !== $this->getX()) {
                    $block = $this->getLevel()->getBlock(new Vector3($x, $y, $this->getZ()));
                    if(RedstoneX::isActive($block)) {
                        $this->setActivated(false);
                    }
                }
            }
        }
        for($z = $this->getZ() - 1; $z <= $this->getZ() + 1; $z++) {
            for($y = $this->getY() - 1; $y <= $this->getY() + 1; $y++) {
                if($x !== $this->getX()) {
                    $block = $this->getLevel()->getBlock(new Vector3($x, $y, $this->getZ()));
                    if(RedstoneX::isActive($block)) {
                        $this->setActivated(false);
                    }
                }
            }
        }
    }

    /**
     * @param bool $activated
     */
    public function setActivated(bool $activated = false) {
        $activated ? $this->getLevel()->setBlock($this->asVector3(), new RedstoneLamp, true, true) : $this->getLevel()->setBlock($this->asVector3(), new RedstoneLampUnlit, true, true);
    }
}
