<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="category", columns={"category"})})
 * @ORM\Entity
 */
class Article
{
    /** 
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** 
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;
    
    /** 
     * @var string
     *
     * @ORM\Column(name="bookImg", type="string", length=100, nullable=true)
     */
    private $bookImg;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", length=100, nullable=true)
     */
    private $price;
    

    /** 
     * @var string
     *
     * @ORM\Column(name="article", type="text", length=65535, nullable=false)
     */
    private $article;

    /** 
     * @var string
     *
     * @ORM\Column(name="short_article", type="text", length=65535, nullable=true)
     */
    private $shortArticle;

    /** 
     * @var boolean
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=false)
     */
    private $isPublic = '0';

    /** 
     * @var \Blog\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Blog\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;

    /**  
     * 
     * @param \Doctrine\Common\Collections\Collection $property
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article", cascade={"persist":"remove"})
     */
    private $comments;
    
    public function getComments() {
        return $this->comments;
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /** 
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set bookImg
     *
     * @param string $bookImg
     *
     * @return string
     */
    public function setBookImg($bookImg)
    {
        $this->bookImg = $bookImg;

        return $this;
    }

    /** 
     * Get bookImg
     *
     * @return string
     */
    public function getBookImg()
    {
        return $this->bookImg;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return string
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }


    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


    /** 
     * Set article
     *
     * @param string $article
     *
     * @return Article
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /** 
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /** 
     * Set shortArticle
     *
     * @param string $shortArticle
     *
     * @return Article
     */
    public function setShortArticle($shortArticle)
    {
        $this->shortArticle = $shortArticle;

        return $this;
    }

    /** 
     * Get shortArticle
     *
     * @return string
     */
    public function getShortArticle()
    {
        return $this->shortArticle;
    }

    /** 
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return Article
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /** 
     * Get isPublic
     *
     * @return boolean
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /** 
     * Set category
     *
     * @param \Blog\Entity\Category $category
     *
     * @return Article
     */
    public function setCategory(\Blog\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /** 
     * Get category
     *
     * @return \Blog\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    public function getArticleForTable() {
        $article = strip_tags($this->getArticle());
        $article = mb_substr($article, 0, 15, 'UTF-8') . '...';
        return $article;
    }
    
    public function getShortArticleForTable() {
        $article = strip_tags($this->getShortArticle());
        $article = mb_substr($article, 0, 20, 'UTF-8') . '...';
        return $article;
    }
    
    public function getShortArticleForBlog() {
        $article = $this->getShortArticle();
        if(empty($article)){
            $article = $this->getArticle();
        }
        return $article;
    }
    
    public function getFullArticle() {
        //$article = $this->getShortArticle() . $this->getArticle();
        $article = $this->getArticle();
        return $article;
    }
    
    public function __toString() {
        return 'Article class';
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comment
     *
     * @param \Blog\Entity\Comment $comment
     *
     * @return Article
     */
    public function addComment(\Blog\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Blog\Entity\Comment $comment
     */
    public function removeComment(\Blog\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }
}
