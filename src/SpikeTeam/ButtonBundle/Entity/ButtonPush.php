<?php

namespace SpikeTeam\ButtonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ButtonPush
 *
 * @ORM\Table(name="button_push")
 * @ORM\Entity
 */
class ButtonPush
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="push_time", type="datetime")
     */
    private $pushTime;

    /**
     * @var integer
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var integer
     * @ORM\Column(name="group_id", type="integer")
     */
    private $groupId;

    /**
     * Construct with $pushTime and $userId
     *
     * @param \DateTime $pushTime
     * @param integer $userId
     */
    public function __construct($pushTime, $userId)
    {
        $this->pushTime = $pushTime;
        $this->userId = $userId;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pushTime
     *
     * @param \DateTime $time
     * @return ButtonPush
     */
    public function setPushTime($time)
    {
        $this->pushTime = $time;

        return $this;
    }

    /**
     * Get pushTime
     *
     * @return \DateTime 
     */
    public function getPushTime()
    {
        return $this->pushTime;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return ButtonPush
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set groupId
     *
     * @param integer $groupId
     * @return ButtonPush
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get groupId
     *
     * @return integer 
     */
    public function getGroupId()
    {
        return $this->groupId;
    }
}
