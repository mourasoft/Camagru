<?php
class Studio
{
	private $db;
	public function __construct()
	{
		$this->db = new Database;
	}

	public function saveImage($data)
	{
		$this->db->query("INSERT INTO `images` SET `id_user` = :id_user, `path` = :path");
		$this->db->bind(':id_user', $data['user_id']);
		$this->db->bind(':path', $data['path']);
		$this->db->execute();
	}

	public function getImages($id)
	{
		$this->db->query("SELECT * FROM `images` WHERE `id_user`= :id_user ORDER BY `id` DESC");
		$this->db->bind('id_user', $id);
		return $this->db->resultSet();
	}

	public function deleteImage($id, $id_user, $image)
	{
		$this->db->query("DELETE  FROM `images` WHERE `id`= :id AND `id_user`=:id_user AND `path` = :path");
		$this->db->bind(':id', $id);
		$this->db->bind(':id_user', $id_user);
		$this->db->bind(':path', $image);
		$this->db->execute();
	}
	public function getAllImage()
	{
		$this->db->query("SELECT `images`.`id`, `images`.`id_user`, `images`.`path`,`users`.`username` from `images` JOIN `users` WHERE `images`.`id_user` = `users`.id ORDER BY `images`.`id` DESC; ");
		return $this->db->resultSet();
	}

	public function checkLike($user, $img)
	{
		$this->db->query("SELECT * FROM `likes` WHERE `user_id` = :user_id AND `image_id` = :image_id");
		$this->db->bind(':user_id', $user);
		$this->db->bind(':image_id', $img);
		$this->db->single();
		$var = $this->db->rowCount();
		if ($var) {
			return true;
		} else
			return false;
	}

	public function addLike($user, $img)
	{
		$this->db->query("INSERT INTO `likes` SET `user_id` = :user_id, `image_id` = :image_id");
		$this->db->bind(':user_id', $user);
		$this->db->bind(':image_id', $img);
		$this->db->execute();
	}
	public function removeLike($user, $img)
	{
		$this->db->query("DELETE FROM `likes` WHERE `user_id` = :user_id AND `image_id` = :image_id");
		$this->db->bind(':user_id', $user);
		$this->db->bind(':image_id', $img);
		$this->db->execute();
	}

	public function addComment($img,$comment,$id_user)
	{
		$this->db->query("INSERT INTO `posts` SET `image_pat` = :img_path, `content` = :content, `id_user` = :id_user");
		$this->db->bind(':img_path', $img);
		$this->db->bind(':content', $comment);
		$this->db->bind(':id_user', $id_user);
		return $this->db->execute();
	}
}
