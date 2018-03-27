<?php

namespace App\Models;

use Core\Model;

/**
 * Class Task.
 */
class Task extends Model
{
    /**
     * Allowed ORDER BY values.
     */
    const orderValues = ['username', 'email', 'status', 'created_at'];

    /**
     * Allowed Direction values.
     */
    const directionValues = ['asc', 'desc'];

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $image;

    /**
     * @var int
     */
    private $status;

    /**
     * Task constructor.
     * @param string $username
     * @param string $email
     * @param string $text
     * @param string null $image
     * @param int $status 0 - Not Done; 1 - Done
     */
    public function __construct($username = null, $email = null, $text = null, $image = null, $status = 0)
    {
        $this->username = $username;
        $this->email = $email;
        $this->text = $text;
        $this->image = $image;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param int $status 0 - Not Done; 1 - Done
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        return APP_DIR . DIR_UPLOADS . '/' . $this->image;
    }

    /**
     * @return string
     */
    public function getStatusText()
    {
        if ($this->status == 1) {
            return 'Done';
        }

        return 'Not Done';
    }

    /**
     * Find all Tasks.
     * @param string $orderBy
     * @param string $direction
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public static function findAll($orderBy = 'created_at', $direction = 'desc', $offset = 0, $limit = 3)
    {
        $order = 'created_at desc';

        if (in_array($orderBy, self::orderValues) &&
            in_array($direction, self::directionValues)
        ) {
            $order = $orderBy . ' ' . $direction;
        }

        $statement = self::$db->prepare('SELECT * FROM ' . DB_TABLE_PREFIX . 'tasks ORDER BY ' . $order . ' LIMIT :limit OFFSET :offset');
        $statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, self::class);
    }

    /**
     * Find one Task.
     * @param int $id
     * @return mixed|self
     */
    public static function find($id)
    {
        $statement = self::$db->prepare('SELECT * FROM ' . DB_TABLE_PREFIX . 'tasks WHERE id = :id LIMIT 1');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, self::class);

        return $statement->fetch();
    }

    /**
     * Save new Task.
     * @return bool
     */
    public function save()
    {
        $statement = self::$db->prepare('INSERT INTO ' . DB_TABLE_PREFIX . 'tasks (username, email, text, image, status) VALUES(:username, :email, :text, :image, :status)');
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':text', $this->text);
        $statement->bindValue(':image', $this->image);
        $statement->bindValue(':status', $this->status, \PDO::PARAM_INT);

        return $statement->execute();
    }

    /**
     * Update Task.
     * @return bool
     */
    public function update()
    {
        $statement = self::$db->prepare('UPDATE ' . DB_TABLE_PREFIX . 'tasks SET username = :username, email = :email, text = :text, image = :image, status = :status WHERE id = :id');
        $statement->bindValue(':username', $this->username);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':text', $this->text);
        $statement->bindValue(':image', $this->image);
        $statement->bindValue(':status', $this->status, \PDO::PARAM_INT);
        $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    /**
     * Delete Task.
     * @return bool
     */
    public function delete()
    {
        $statement = self::$db->prepare('DELETE FROM ' . DB_TABLE_PREFIX . 'tasks WHERE id = :id');
        $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    /**
     * @return string
     */
    public static function countAll()
    {
        $statement = self::$db->prepare('SELECT COUNT(*) FROM ' . DB_TABLE_PREFIX . 'tasks');
        $statement->execute();

        return $statement->fetchColumn();
    }
}
