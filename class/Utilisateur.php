<?php

/** @Entity @Table(name="utilisateur") **/
class Utilisateur
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    public $id;
    /** @Login @Column(type="string", length=2000) **/
    public $login;
    /** @Passwd @Column(type="string"), length=2000 **/
    public $passwd;
    /** @Pseudo @Column(type="string"), length=2000 **/
    public $pseudo;
    /** @admin @Column (type="integer") */
    public $admin;

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
     * Set login.
     *
     * @param string $login
     *
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set passwd.
     *
     * @param string $passwd
     *
     * @return Utilisateur
     */
    public function setPasswd($passwd)
    {
        $hash = password_hash($passwd, PASSWORD_DEFAULT);

        $this->passwd = $hash;

        return $this;
    }

    /**
     * Get passwd.
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Set pseudo.
     *
     * @param string $pseudo
     *
     * @return Utilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo.
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set admin.
     *
     * @param int $admin
     *
     * @return Utilisateur
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin.
     *
     * @return int
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
