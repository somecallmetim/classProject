<?php
/**
 * Created by PhpStorm.
 * User: mayara
 * Date: 4/11/17
 * Time: 7:26 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Table(name="item_post_photo")
 * @ORM\Entity()
 */
class ItemPostPhoto {



    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(name="path", type="text")
     */

    private $path;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="itemPostPhoto", fileNameProperty="photoName", size="photoSize")
     *
     * @var File
     */
    private $photoFile;
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $photoName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $photoSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity="ItemPost", inversedBy="photos")
     * @ORM\JoinColumn(name="item_post_id", referencedColumnName="id", nullable=false)
     */
    private $itemPost;

    /**
     * ItemPostPhoto constructor.
     * path to photo, item post object
     * @param $path String
     * @param $itemPost ItemPost
     */
    public function __construct($path, $itemPost)
    {
        $this->path = $path;
        $this->itemPost = $itemPost;
    }

    /**
     * photo id
     * @return Integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $photo
     *
     * @return ItemPostPhoto
     */
    public function setPhotoFile(File $photo = null)
    {
        $this->photoFile = $photo;

        if ($photo) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * @param string $photoName
     *
     * @return itemPostPhoto
     */
    public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhotoName()
    {
        return $this->photoName;
    }

    /**
     * @param integer $photoSize
     *
     * @return itemPostPhoto
     */
    public function setphotoSize($photoSize)
    {
        $this->photoSize = $photoSize;

        return $this;
    }

    /**
     * @return integer|null
     */
    public function getPhotoSize()
    {
        return $this->photoSize;
    }
    /**
     * photo's item post
     * @return ItemPost
     */
    public function getItemPost()
    {
        return $this->itemPost;
    }

}