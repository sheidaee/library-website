<?php
//کلاس کار با بانک اطلاعاتی
class Database{
    private $host    = DB_HOST;
    private $user    = DB_USER;
    private $pass   = DB_PASS;
    private $dbname = DB_NAME;
 
    private $dbh;
    private $error;
	
    private $stmt;
 
    // Connect database	 	 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname .';charset=utf8';
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,            
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION             
        );
        // Create a new PDO instanace
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
	/**
	 * Query database
	 * @param string $query input string for query
	 * @return result query records
	 */
	public function query($query) {
    		$this->stmt = $this->dbh->prepare($query);		
	}
	
	public function bind($param, $value, $type = null){
	    if (is_null($type)) {
	        switch (true) {
	            case is_int($value):
	                $type = PDO::PARAM_INT;
	                break;
	            case is_bool($value):
	                $type = PDO::PARAM_BOOL;
	                break;
	            case is_null($value):
	                $type = PDO::PARAM_NULL;
	                break;
	            default:
	                $type = PDO::PARAM_STR;
	        }
	    }
	    $this->stmt->bindValue($param, $value, $type);	
	}
	
	public function execute(){
	    return $this->stmt->execute();
	}
	
	public function resultset(){
	    $this->execute();
	    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function single(){
	    $this->execute();
	    return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function rowCount(){
	    return $this->stmt->rowCount();
	}
	
	public function lastInsertId(){
	    return $this->dbh->lastInsertId();
	}
	
	public function beginTransaction(){
	    return $this->dbh->beginTransaction();
	}
	
	public function endTransaction(){
	    return $this->dbh->commit();
	}
	
	public function cancelTransaction(){
	    return $this->dbh->rollBack();
	}
	
	public function debugDumpParams(){
	    return $this->stmt->debugDumpParams();
	}
	
	
}

//جهت اختصاص نام به هر صفحه به کار می رود
function lib_title()
{	
	global $page;

	if(isset($page))
		return $page;
	else
		return SITE_NAME;
}

//جهت ایجاد تصویر بند انگشتی به کار می رود
function createThumbnail($filename) {  
         
     if(preg_match('/[.](jpg)$/', $filename)) {  
         $im = imagecreatefromjpeg(PATH_IMG . $filename);  
     } else if (preg_match('/[.](gif)$/', $filename)) {  
         $im = imagecreatefromgif(PATH_IMG . $filename);  
     }  
          
     $ox = imagesx($im);  
     $oy = imagesy($im);  
       
     $nx = FINAL_IMG_WIDTH;  
     // $ny = floor($oy * (FINAL_IMG_WIDTH / $ox));  
     $ny = FINAL_IMG_HEIGHT;
       
     $nm = imagecreatetruecolor($nx, $ny);  
       
     imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);  
         
     if(!file_exists(PATH_THUMBS)) {  
       	if(!mkdir(PATH_THUMBS)) {  
            die("مشکلی در ایجاد تصویر بند انگشتی بوجود آمده است.");  
       	}   
     }  
     
     imagejpeg($nm, PATH_THUMBS . $filename);  
}