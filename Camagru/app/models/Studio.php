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
    
}