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
    
}