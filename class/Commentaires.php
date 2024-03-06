<?php

/** @Entity @Table(name="commentaires") **/
class Commentaires
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Column(type="string", length=2000) **/
    public $contenu;
    /** @Column(type="datetime"), nullable=true **/
    public $date_publication;
    /**
     * @ManyToOne(targetEntity="Billets")
     * @JoinColumn(nullable=false)
     */
    public $billets;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contenu.
     *
     * @param string $contenu
     *
     * @return Commentaires
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu.
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set datePublication.
     *
     * @param \DateTime $datePublication
     *
     * @return Commentaires
     */
    public function setDatePublication($datePublication)
    {
        $this->date_publication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication.
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->date_publication;
    }

    /**
     * Set billets.
     *
     * @param \Billets $billets
     *
     * @return Commentaires
     */
    public function setBillets(\Billets $billets)
    {
        $this->billets = $billets;

        return $this;
    }

    /**
     * Get billets.
     *
     * @return \Billets
     */
    public function getBillets()
    {
        return $this->billets;
    }
}
