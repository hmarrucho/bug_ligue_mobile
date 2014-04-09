<?php
use Doctrine\Common\Collections\ArrayCollection;
// src/Bug.php
/**
 * @Entity @Table(name="bugs")
 **/
class Bug
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="string",nullable=true)
     **/
    protected $resume;
    /**
     * @Column(type="string")
     **/
    protected $description;
    /**
     * @Column(type="string",nullable=true)
     **/
    protected $note;
    /**
     * @Column(type="datetime")
     **/
    protected $created;
    /**
     * @Column(type="string")
     **/
    protected $status = 'Ouvert';

    /**
     * @ManyToOne(targetEntity="User", inversedBy="assignedBugs", cascade={"persist"})
     * @ORM\JoinColumn(name="engineer_id", referencedColumnName="id", nullable="true")
     **/
    protected $engineer;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="reportedBugs")
     **/
    protected $reporter;

    /**
     * @ManyToMany(targetEntity="Product")
     **/
    protected $products;
    /**
     * @Column(type="string")
     **/
    protected $priorite = 'Normal';

    /**
     * @Column(type="string",nullable=true)
     **/
    protected $image;

    /**
     * @param mixed $priorite
     */
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;
    }

    /**
     * @return mixed
     */
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setNote($note)
    {
        $this->note = $note;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function setEngineer($engineer)
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    public function setReporter($reporter)
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    public function getEngineer()
    {
        return $this->engineer;
    }

    public function getReporter()
    {
        return $this->reporter;
    }

    public function assignToProduct($product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getProductsName(){
        $nameP ="";
        foreach ($this->getProducts() as $product) {
            $nameP = $nameP. "- ".$product->getName()."</br>";
        }
        return $nameP;
    }
    public function close()
    {
        $this->status = "CLOSE";
    }
    public function jsonSerialize()
    {
        if($this->getEngineer() == null){
            $Engineer = "non affecté";
        }else{
            $Engineer = $this->getEngineer()->getName();
        }

        return array(
            'id'=> $this->id,
            'resume'=> $this->resume,
            'description'=> $this->description,
            'note'=> $this->note,
            'created'=> $this->created,
            'engineer'=>$Engineer,
            'reporter'=>$this->getReporter()->getName(),
            'products'=>$this->getProductsName(),
            'priorite'=>$this->priorite,
            'image'=>$this->image,
            'status'=>$this->status
        );
    }
}