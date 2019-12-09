<?php
namespace App\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * Class TimeStamTrait
     * @HasLifecycleCallbacks()
     */
Trait TimeStamTrait {

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at",type="datetime",nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="modified_at",type="datetime",nullable=true)
     */
    protected $modifiedAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(){
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedAt(){
        return $this->modifiedAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt){
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param \DateTime $modifiedAt
     * @return $this
     */
    public function setModifiedAt(\DateTime $modifiedAt){
        $this->modifiedAt = $modifiedAt;
        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPersist(){
        $this->createdAt = new \DateTime('NOW');
    }

    /**
     * @ORM\PreUpdate()
     */
    public function onUpdate(){
        $this->modifiedAt = new \DateTime('NOW');
    }

}