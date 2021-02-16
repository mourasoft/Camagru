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
		$this->db->bind(':path',$data['path']);
		$this->db->execute();	
	}

	public function getImages($id)
	{
		$this->db->query("SELECT * FROM `images` WHERE `id_user`= :id_user ORDER BY `id` DESC");
		$this->db->bind('id_user',$id);
		return $this->db->resultSet();
	}

	public function deleteImage($id, $id_user, $image)
	{
		$this->db->query("DELETE  FROM `images` WHERE `id`= :id AND `id_user`=:id_user AND `path` = :path");
		$this->db->bind(':id', $id);
		$this->db->bind(':id_user',$id_user);
		$this->db->bind(':path',$image);
		$this->db->execute();	
	}
	public function getAllImage(){
		$this->db->query("SELECT `images`.`id`, `images`.`id_user`, `images`.`path`,`users`.`username` from `images` JOIN `users` WHERE `images`.`id_user` = `users`.id ORDER BY `images`.`id` DESC; ");
		return $this->db->resultSet();
	}
	
    
}