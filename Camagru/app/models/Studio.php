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
	public function getAllImage($start,$perPage)
	{
		$this->db->query("SELECT images.id, images.path, users.username, COUNT(posts.id_comment) as commentsCount  from images JOIN `users` on images.id_user = users.id LEFT JOIN posts on images.path = posts.image_pat  group by images.id ORDER BY `images`.`id` DESC LIMIT $start,$perPage; ");
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

	public function addComment($img, $comment, $id_user)
	{
		$this->db->query("INSERT INTO `posts` SET `image_pat` = :img_path, `content` = :content, `id_user` = :id_user");
		$this->db->bind(':img_path', $img);
		$this->db->bind(':content', $comment);
		$this->db->bind(':id_user', $id_user);
		return $this->db->execute();
	}

	public function getNotif($img)
	{
		$this->db->query("SELECT users.email, users.notif FROM `images`  JOIN users ON images.id_user = users.id where images.path = :img");
		$this->db->bind(':img', $img);
		return $this->db->single();
	}

	private function getCommentsBypath($img)
	{
		$this->db->query("SELECT posts.content, users.username from posts Join users on users.id = posts.id_user WHERE posts.image_pat = :img_path ");
		$this->db->bind(':img_path', $img);
		return $this->db->resultSet();
	}

	private function getLikedStatus($img, $userID)
	{
		$this->db->query("SELECT * FROM `likes` WHERE likes.image_id = :img AND likes.user_id = :userID");
		$this->db->bind(':img', $img);
		$this->db->bind(':userID', $userID);
		$this->db->execute();
		return ($this->db->rowCount() ? true : false);
	}

	private function getLikesCount($img)
	{
		$this->db->query("SELECT count(likes.image_id) as likes from likes WHERE likes.image_id = :img");
		$this->db->bind(':img', $img);
		return $this->db->single();
	}

	/**
	 * set comments && likes count && liked status
	 */
	public function setData($imgs, $userID)
	{
		// 
		foreach ($imgs as $img) {
			$img->likes = $this->getLikesCount($img->path)->likes;
			if ($img->commentsCount != 0) {
				$img->comments = $this->getCommentsBypath($img->path);
			} else {
				$img->comments = false;
			}
			if ($img->likes != 0) {
				$img->liked_status = $this->getLikedStatus($img->path, $userID);
			} else {
				$img->liked_status = false;
			}
		}
		return $imgs;
	}
	public function countAllImage()
	{
		$this->db->query("SELECT COUNT(images.id) as countPost FROM `images`");
		return $this->db->single()->countPost;
	}
}
