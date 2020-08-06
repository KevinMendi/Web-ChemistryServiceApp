<?php
/*Add this function to every pages
function __autoload($class)
{
	require_once "classes/$class.php";
}


*/


/**
 * 
 */
class Chempo extends Db
{
    
    //BLOG FUNCTIONS - RCW //
    //insert new blog
   public function insertBlog($fields,$table_name)
	{
	$implodeColumns = implode(', ',array_keys($fields));
	$implodePlaceholder = implode(", :", array_keys($fields));
	//$sql = "INSERT INTO tb_companies ($implodeColumns) VALUES (:".$implodePlaceholder.")";

	$sql = "";
	$sql.="INSERT INTO ".$table_name;
	$sql.=" (".$implodeColumns.") ";
	$sql.="VALUES (:".$implodePlaceholder.")";

	$stmt = $this->connectBlogs()->prepare($sql);

		foreach ($fields as $key => $value) {
			$stmt->bindValue(':'.$key,$value);
		}

		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
		}
		else
		{
			return 0;
		}


	}
    
    
    //blogList
    public function searchBlogs($limit)
    {
        if ($limit == "10")
        {
           $sql = "SELECT * FROM `chempo_posts` WHERE post_status=0 AND del_status=0 ORDER BY post_ID DESC"; 
        }else if ($limit == '1')
        {
          $sql = "SELECT * FROM `chempo_posts` WHERE post_status=0 AND del_status=0 AND post_category=1 ORDER BY post_ID DESC";
        }else if ($limit == '2')
        {
            $sql = "SELECT * FROM `chempo_posts` WHERE post_status=0 AND del_status=0 AND post_category=2 ORDER BY post_ID DESC";
        }else if ($limit == '3')
        {
            $sql = "SELECT * FROM `chempo_posts` WHERE post_status=0 AND del_status=0 AND post_category=3 ORDER BY post_ID DESC";
        }
        else
        {
          $sql = "SELECT * FROM `chempo_posts` WHERE post_status=0 AND del_status=0 ORDER BY post_ID DESC";     
        }
        
        
        $result = $this->connectBlogs()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
        
    }
    
    public function searchDrafts()
    {
        $sql = "SELECT * FROM `chempo_posts` WHERE post_status=1 AND del_status=0 ORDER BY post_ID DESC ";
        
        $result = $this->connectBlogs()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
        
        
    }
    
    public function viewBlogCat()
    {
        $sql = "SELECT * FROM `chempo_blog_categories`";
        
        $result2 = $this->connectBlogs()->query($sql);

		if($result2->rowCount() > 0)
		{
			//
			while ($row2 = $result2->fetch())
			{
				$data[] = $row2;
			}
			return $data;
		}
    }
    
    public function viewBlogCatEdit($id)
    {
        $sql = "SELECT * FROM `chempo_blog_categories` WHERE chempo_blog_categories.category_ID = :id";
        
        $stmt = $this->connectBlogs()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    //to select the photo
    public function selectBlogBanner($id)
	{
		
		$sql = "SELECT blog_img FROM chempo_posts WHERE post_ID = :id";

		$stmt = $this->connectBlogs()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
    
    //UPDATE BLOGS
    public function updateBlogs($fields,$id,$table_name,$whereClause)
	{
		$st = "";
		$counter = 1;
		$total_fields = count($fields);
		foreach ($fields as $key => $value) {
			if($counter === $total_fields)
			{
				$set = "$key = :".$key;
				$st = $st.$set;
			}
			else
			{
				$set = "$key = :".$key.", ";
				$st = $st.$set;
				$counter++;
			}
		}

		$sql ="";
		$sql.="UPDATE ".$table_name;
		$sql.=" SET ".$st;
		$sql.=" WHERE ".$whereClause;
		$sql.=" = ".$id;

		$stmt = $this->connectBlogs()->prepare($sql);

		foreach ($fields as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		
		}
		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
		}
		else
		{
			return 0;
		}


	}

    
    //DISPLAY BLOG CONTENTS
    public function viewBlogContent($post_ID)
    {
        $sql = "SELECT * FROM `chempo_posts` WHERE chempo_posts.post_ID = :id";
        
        $stmt = $this->connectBlogs()->prepare($sql);
        $stmt->bindValue(":id", $post_ID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        
    }
    
    //DISPLAY BLOG OF THE DAY
    public function viewBlogOfTheDay($post_ID)
    {
        $sql = "SELECT * FROM `chempo_posts` WHERE chempo_posts.post_category = :id ORDER BY chempo_posts.post_ID DESC LIMIT 1";
        //$sql = "SELECT * FROM `chempo_posts` WHERE chempo_posts.post_ID = :id";
        
        $stmt = $this->connectBlogs()->prepare($sql);
        $stmt->bindValue(":id", $post_ID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        
    }
    
    //VIEW COMMENTS (BLOG)
    public function viewComments($post_ID)
    {
        
        $sql = "SELECT * FROM `chempo_comments` WHERE post_ID =".$post_ID." ORDER BY comment_ID DESC";
        
        $result = $this->connectBlogs()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
        
    }
    
    //COUNT COMMENTS (BLOG)
    public function countComments($un)
	{
		
		$sql = "SELECT COUNT(comment_Name) AS commentCount FROM chempo_comments WHERE post_ID = :uname";
		$stmt = $this->connectBlogs()->prepare($sql);
		$stmt->bindValue(":uname",$un);
		$stmt->execute();
		$result2 = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result2;
	}

    
    //insert new Comment
    public function insertComment($fields,$table_name)
	{
	$implodeColumns = implode(', ',array_keys($fields));
	$implodePlaceholder = implode(", :", array_keys($fields));
	//$sql = "INSERT INTO tb_companies ($implodeColumns) VALUES (:".$implodePlaceholder.")";

	$sql = "";
	$sql.="INSERT INTO ".$table_name;
	$sql.=" (".$implodeColumns.") ";
	$sql.="VALUES (:".$implodePlaceholder.")";

	$stmt = $this->connectBlogs()->prepare($sql);

		foreach ($fields as $key => $value) {
			$stmt->bindValue(':'.$key,$value);
		}

		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
		}
		else
		{
			return 0;
		}


	}

//to check if company is paid or not yet.
public function checkSubscription($company_id)
{
    
    $sql = "SELECT * FROM tb_companies WHERE tb_companies.company_id = :compid";
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":compid",$company_id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
    
}

public function countUser($un)
	{
		
		$sql = "SELECT COUNT(username) AS userCount FROM tb_users WHERE username = :uname";
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":uname",$un);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

public function countUserEmail($email)
	{
		
		$sql = "SELECT COUNT(email) AS emailCount FROM tb_users WHERE email = :email";
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":email",$email);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}




	public function readPPhrase($id)
	{
		$sql = "SELECT pphrase1, pphrase2, pphrase3, pphrase3, pphrase4, pphrase5, pphrase6 FROM `tb_phrases` WHERE chemical_header_id = ".$id;
		//$this is a reference of this class as well as Db

		$result = $this->connect2()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function chemicalsList()
	{
		$sql = "SELECT chemical_header_id, begin_of_pname, cas_no, un_no, tb_chemical_header.del_status, company_id FROM tb_chemical_header INNER JOIN tb_users ON tb_chemical_header.user_id = tb_users.user_id WHERE tb_chemical_header.del_status IS NULL";
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	 public function chemicalsListIndex()
	{
		$sql = "SELECT chemical_header_id, begin_of_pname, cas_no, un_no FROM tb_chemical_header LIMIT 3";
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function search($search_text)
	{
		$sql="";

		//if last char is *
		if((substr($search_text, -1) == '*' ) && (substr($search_text, 0, 1) != '*'))
		{
			$search_text = substr($search_text, 0, -1);

			$sql = "SELECT chemical_header_id, begin_of_pname, cas_no, un_no FROM tb_chemical_header WHERE cas_no LIKE '$search_text%' OR  un_no LIKE '$search_text%' OR  iupac_name LIKE '$search_text%' OR  begin_of_pname LIKE '$search_text%'";
		}
		//if first char is *
		else if((substr($search_text, 0, 1) == '*') && (substr($search_text, -1) != '*' ))
		{
			$search_text = ltrim($search_text, '*');

			$sql = "SELECT chemical_header_id, begin_of_pname, cas_no, un_no FROM tb_chemical_header WHERE cas_no LIKE '%$search_text' OR  un_no LIKE '%$search_text' OR  iupac_name LIKE '%$search_text' OR  begin_of_pname LIKE '%$search_text' ";



		}
	
		else if((substr($search_text, -1) == '*') && (substr($search_text, 0, 1) == '*'))
		{
			$search_text = substr($search_text, 0, -1);
			$search_text = ltrim($search_text, '*');

			$sql = "SELECT chemical_header_id, begin_of_pname, cas_no, un_no FROM tb_chemical_header WHERE cas_no LIKE '%$search_text%' OR  un_no LIKE '%$search_text%' OR  iupac_name LIKE '%$search_text%' OR  begin_of_pname LIKE '%$search_text%'"; 
		}
		
		else
		{
		
			$sql = "SELECT chemical_header_id, begin_of_pname, cas_no, un_no FROM tb_chemical_header WHERE cas_no LIKE '%$search_text%' OR  un_no LIKE '%$search_text%' OR  iupac_name LIKE '%$search_text%' OR  begin_of_pname LIKE '%$search_text%'";
			
		}

		
		//$this is a reference of this class as well as Db
		//$result = $this->connect()->query($sql);
		//$stmt = $this->connect()->prepare($sql);
		//$stmt->bindValue(":search_text",$search_text);
		//$stmt->execute();
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			$data = 0;
		}


		
	}
	
	public function hphrasesList()
	{
		$sql = "SELECT `phrase_phrasentext`.phrasentext_id AS phrasetextId, `phrase_phrasentext`.phrasencode AS h_phrasencode, CONCAT(`phrase_phrasentext`.phrasencode,' - ', `phrase_phrasentext`.phrasentext) AS hphrase FROM `phrase_phrasentext` WHERE ( `phrase_phrasentext`.phrasencode LIKE 'H2%' or `phrase_phrasentext`.phrasencode LIKE 'H3%' or `phrase_phrasentext`.phrasencode LIKE 'H4%') and `phrase_phrasentext`.sprache_id = 15 GROUP BY `phrase_phrasentext`.phrasencode";
		//$this is a reference of this class as well as Db

		$result = $this->connect2()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	public function pphrasesList()
	{
		$sql = "SELECT phrasentext_id AS phrasetextId, phrasencode AS p_phrasencode, CONCAT(phrasencode,' - ', phrasentext) AS pphrase FROM `phrase_phrasentext` WHERE ( phrasencode LIKE 'P1%' or phrasencode LIKE 'P2%' or phrasencode LIKE 'P3%' or phrasencode LIKE 'P4%' or phrasencode LIKE 'P5%') and sprache_id = 15 GROUP BY phrasencode";
		//$this is a reference of this class as well as Db

		$result = $this->connect2()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function readChemicalInfo($id)
	{
		
		$sql = "SELECT * FROM tb_chemical_header INNER JOIN tb_chemical_properties ON tb_chemical_header.chemical_header_id = tb_chemical_properties.chemical_header_id INNER JOIN tb_ghs_label_temp ON tb_chemical_header.chemical_header_id = tb_ghs_label_temp.chemical_header_id INNER JOIN tb_phrases ON tb_chemical_header.chemical_header_id = tb_phrases.chemical_header_id  WHERE tb_chemical_header.chemical_header_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function countAllChem()
	{
		
		$sql = "SELECT COUNT(*) AS allChem FROM tb_chemical_header";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function countGHS($id)
	{
		
		$sql = "SELECT ghs1, ghs2, ghs3, ghs4, ghs5, ghs6, ghs7, ghs8, ghs9, chemical_header_id FROM tb_ghs_label_temp WHERE tb_ghs_label_temp.chemical_header_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function readGhs($id)
	{
		
		$sql = "SELECT * FROM tb_ghs_label_temp  WHERE tb_ghs_label_temp.chemical_header_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

public function insertHeader($fields_header)
{
	$implodeColumns = implode(', ',array_keys($fields_header));
	$implodePlaceholder = implode(", :", array_keys($fields_header));
	$sql = "INSERT INTO tb_chemical_header ($implodeColumns) VALUES (:".$implodePlaceholder.")";
	$stmt = $this->connect()->prepare($sql);

		foreach ($fields_header as $key => $value) {
			$stmt->bindValue(':'.$key,$value);
		}

		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			
			$sql = "SELECT max(chemical_header_id) AS cur_internal_no FROM tb_chemical_header";

				

				$stmt2 = $this->connect()->prepare($sql);
				$stmt2->execute();
  				$invNum = $stmt2->fetch(PDO::FETCH_ASSOC);
  				$max_id = $invNum['cur_internal_no'];
				return $max_id;

		//header('Location: chemicals-list.php');
				
				

		}
		else
		{
			header('Location: chemicalsist.php');
			return 0;

		}
}






public function updateHeader($header_fields,$id)
	{
		$st = "";
		$counter = 1;
		$total_fields = count($header_fields);
		foreach ($header_fields as $key => $value) {
			if($counter === $total_fields)
			{
				$set = "$key = :".$key;
				$st = $st.$set;
			}
			else
			{
				$set = "$key = :".$key.", ";
				$st = $st.$set;
				$counter++;
			}
		}

		$sql ="";
		$sql.="UPDATE tb_chemical_header SET ".$st;
		$sql.=" WHERE chemical_header_id = ".$id;

		$stmt = $this->connect()->prepare($sql);

		foreach ($header_fields as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		
		}
		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
		}
		else
		{
			return 0;
		}


	}

	public function updateProperties($properties_fields,$id)
	{
		$st = "";
		$counter = 1;
		$total_fields = count($properties_fields);
		foreach ($properties_fields as $key => $value) {
			if($counter === $total_fields)
			{
				$set = "$key = :".$key;
				$st = $st.$set;
			}
			else
			{
				$set = "$key = :".$key.", ";
				$st = $st.$set;
				$counter++;
			}
		}

		$sql ="";
		$sql.="UPDATE tb_chemical_properties SET ".$st;
		$sql.=" WHERE chemical_header_id = ".$id;

		$stmt = $this->connect()->prepare($sql);

		foreach ($properties_fields as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		
		}
		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			header('Location: chemicals-list.php');
		}
		else
		{
			return 0;
		}


	}



///////////////////////COMPANY

	public function selectCompanyStatus($companyId)
	{
		$sql = "SELECT * FROM tb_companies WHERE company_id = :companyId";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":companyId",$companyId);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	public function companyChemicalsList($id)
	{
		$sql = "SELECT * FROM `tb_chemical_header` INNER JOIN tb_users ON tb_chemical_header.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id WHERE tb_chemical_header.del_status IS NULL AND tb_companies.company_id = ".$id;
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function readCompanyInfo($id)
	{
		
		$sql = "SELECT * FROM tb_companies WHERE company_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	public function selectLogoName($id)
	{
		
		$sql = "SELECT company_logo FROM tb_companies WHERE company_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function companiesList()
	{
		$sql = "SELECT company_id, company_name, company_address1 AS compAddress, del_status FROM tb_companies WHERE del_status IS NULL";
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	public function countAllCompanies()
	{
		
		$sql = "SELECT COUNT(*) AS allCompanies FROM tb_companies";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function countNumOfUserAddedCompany($id)
	{
		
		$sql = "SELECT COUNT(*) AS compUser FROM tb_users WHERE tb_users.company_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function countNumOfChemAddedCompany($id)
	{
		
		$sql = "SELECT COUNT(*) AS compChem FROM tb_chemical_header INNER JOIN tb_users ON tb_chemical_header.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id WHERE tb_companies.company_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function countNumOfCertAddedCompany($id)
	{
		
		$sql = "SELECT COUNT(*) AS compCert FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id WHERE tb_companies.company_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function companyregisteredUsers($uid,$role)
	{
		 if ($role == '4')
        {
            $sql = "SELECT user_id, CONCAT(f_name,' ', m_name, ' ', l_name) AS name, username, email, del_status FROM tb_users WHERE del_status IS NULL AND company_id = ".$uid;
        } else if ($role == '3') {
            $sql = "SELECT user_id, CONCAT(f_name,' ', m_name, ' ', l_name) AS name, username, email, del_status FROM tb_users WHERE tb_users.role_id < 4 AND del_status IS NULL AND company_id = ".$uid;
        } else {
            $sql = "SELECT user_id, CONCAT(f_name,' ', m_name, ' ', l_name) AS name, username, email, del_status FROM tb_users WHERE tb_users.role_id < 3 AND del_status IS NULL AND company_id = ".$uid;
        }
        
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function companyUploadedCertificates($uid)
	{
		$sql = "SELECT tb_battery_cert.battery_cert_id, tb_battery_cert.prod_name, 	tb_battery_cert.batt_name, tb_battery_cert.batt_category, tb_battery_cert.batt_type, tb_battery_cert.batt_lithium_content, tb_battery_cert.batt_watthour_rating, tb_battery_cert.batt_weight, tb_battery_cert.batt_cellsPerBatt, tb_battery_cert.cells_batt_per_device, tb_battery_cert.batt_supplier, tb_battery_cert.batt_cert, CONCAT(f_name, ' ', l_name) AS name, tb_companies.company_name FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id  WHERE tb_battery_cert.del_status IS NULL AND tb_companies.company_id = ".$uid;
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}



	///////////////////////////////////////////Users

	public function userChemicalsList($id)
	{
		$sql = "SELECT * FROM `tb_chemical_header` INNER JOIN tb_users ON tb_chemical_header.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id WHERE tb_chemical_header.del_status IS NULL AND tb_chemical_header.user_id = ".$id;
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}


	public function userUploadedCertificates($uid)
	{
		$sql = "SELECT tb_battery_cert.battery_cert_id, tb_battery_cert.prod_name, 	tb_battery_cert.batt_name, tb_battery_cert.batt_category, tb_battery_cert.batt_type, tb_battery_cert.batt_lithium_content, tb_battery_cert.batt_watthour_rating, tb_battery_cert.batt_weight, tb_battery_cert.batt_cellsPerBatt, tb_battery_cert.cells_batt_per_device, tb_battery_cert.batt_supplier, tb_battery_cert.batt_cert, CONCAT(f_name, ' ', l_name) AS name, tb_companies.company_name FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id  WHERE tb_battery_cert.del_status IS NULL AND tb_battery_cert.user_id = ".$uid;
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}




	public function usersList($uid,$role)
	{
		$sql = "";
		if($role == '4')
		{
			/*$sql = "SELECT user_id, salutation, CONCAT(f_name, ' ',m_name, ' ', l_name) AS fullName, email, tb_users.company_id, company_name FROM tb_companies INNER JOIN tb_users ON tb_companies.company_id = tb_users.company_id WHERE tb_users.del_status IS NULL";*/
            //para makita ang mga regular users
            $sql = "SELECT user_id, salutation, CONCAT(f_name, ' ',m_name, ' ', l_name) AS fullName, email, company_id FROM tb_users WHERE tb_users.del_status IS NULL";
            
		}else if ($role == '3') {
            
            $sql = "SELECT user_id, salutation, CONCAT(f_name, ' ',m_name, ' ', l_name) AS fullName, email, tb_users.company_id, company_name FROM tb_companies INNER JOIN tb_users ON tb_companies.company_id = tb_users.company_id WHERE tb_users.role_id < 4 AND  tb_users.del_status IS NULL";
        }
		else
		{
			$sql = "SELECT user_id, salutation, CONCAT(f_name, ' ',m_name, ' ', l_name) AS fullName, email, tb_users.company_id, company_name FROM tb_companies INNER JOIN tb_users ON tb_companies.company_id = tb_users.company_id WHERE tb_users.role_id < 3 AND tb_users.del_status IS NULL AND tb_companies.company_id = ".$uid;
		}

		
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	public function selectCompany()
	{
		$sql = "SELECT company_id, company_name, del_status  FROM tb_companies WHERE del_status IS NULL";
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}
    
    public function selectSpecificCompany($uid)
	{
		$sql = "SELECT company_id, company_name, del_status  FROM tb_companies WHERE del_status IS NULL AND company_id = ".$uid;
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function readUserInfo($id)
	{
		
		$sql = "SELECT * FROM tb_users INNER JOIN tb_role ON tb_users.role_id = tb_role.role_id INNER JOIN tb_usergroup ON tb_users.usergroup_id = tb_usergroup.usergroup_id WHERE tb_users.user_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function countAllusers()
	{
		
		$sql = "SELECT COUNT(*) AS allUsers FROM tb_users";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	public function countNumOfChemAdded($id)
	{
		
		$sql = "SELECT COUNT(*) AS chemAdded FROM tb_chemical_header WHERE tb_chemical_header.user_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function countNumOfCertAdded($id)
	{
		
		$sql = "SELECT COUNT(*) AS certAdded FROM tb_battery_cert WHERE tb_battery_cert.user_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

////////////





	public function selectUserRole()
	{
		$sql = "SELECT *  FROM tb_role";
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function selectUserGroup($role_id)
	{
		if($role_id == '4') {
           $sql = "SELECT *  FROM tb_usergroup";
            //$this is a reference of this class as well as Db
            
        } else if ($role_id == '3') {
            $sql = "SELECT * FROM `tb_usergroup` WHERE usergroup_id < 5";
            //$this is a reference of this class as well as Db
            
        } else if ($role_id == '2') {
            $sql = "SELECT * FROM `tb_usergroup` WHERE usergroup_id < 4";
            //$this is a reference of this class as well as Db
            
        } else { 
            $sql = "SELECT * FROM `tb_usergroup` WHERE usergroup_id < 2";
            //$this is a reference of this class as well as Db
        }
        
		
        $result = $this->connect()->query($sql); 

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	



	public function credentialCheck($username, $password)
	{
		$role = 0;
		

		//internal user master admin and admin
		$sql = "SELECT * FROM tb_users INNER JOIN tb_role ON tb_users.role_id = tb_role.role_id INNER JOIN tb_usergroup ON tb_users.usergroup_id = tb_usergroup.usergroup_id WHERE tb_users.del_status IS NULL AND tb_users.username = :username ";

		

		//$this is a reference of this class as well as Db
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(':username', $username);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result === false)
		{
	
		return 0;

		}
		else
		{
			$validPassword = password_verify($password, $result['password']);
			 if($validPassword){
            
            
            	
			 		$_SESSION['user_id'] = $result['user_id'];
			 		$_SESSION['name'] = $result['f_name'];
			 		$_SESSION['username'] = $result['username'];
			 		$_SESSION['company_id'] = $result['company_id'];
			 		$_SESSION['user_role_id'] = $result['role_id'];
			 		$_SESSION['user_group_id'] = $result['usergroup_id'];
			 		$_SESSION['user_role_name'] = $result['role_name'];
			 		$_SESSION['user_group_name'] = $result['group_name'];
			 		$_SESSION['profile_pic_name'] = $result['profile_pic'];
			 		$_SESSION['logged_in_time'] = time();
			 		return 1;
			 		exit;
            
			 	
			 	
         
           
            
            
        	}
         	else
         	{
            return 0;
            exit;
        	}
		}

	}



	
//////////////////////////////////LABEL
public function selectLanguageToPrint()
	{
		
		$sql = "SELECT phrase_sprache.sprache_id AS languageID, CONCAT(sprachentext, ' - ', sprache_iso2) AS lang FROM phrase_sprache INNER JOIN phrase_sprachentext ON phrase_sprache.sprache_id = phrase_sprachentext.sprache_id WHERE phrase_sprachentext.anzeigesprache_id = 15 ORDER BY lang";

		//$this is a reference of this class as well as Db

		$result = $this->connect2()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	

	public function labelList()
	{
		$sql = "SELECT * FROM (SELECT etikett.produktname, etikett.etikett_id AS u1, etikett.sprache_1_id, CONCAT(sprachentext.sprachentext, ' - ', sprache.sprache_iso2) AS sprache1, etikett.inhalt_sprache_1 AS inhaltSprache1 FROM phrase_etikett AS etikett INNER JOIN phrase_sprache AS sprache ON etikett.sprache_1_id = sprache.sprache_id INNER JOIN phrase_sprachentext AS sprachentext ON sprache.sprache_id = sprachentext.sprache_id  GROUP BY u1) AS t1
INNER JOIN 
(SELECT etikett.etikett_id AS u2, etikett.sprache_2_id, CONCAT(sprachentext.sprachentext, ' - ', sprache.sprache_iso2) AS sprache2 FROM phrase_etikett AS etikett INNER JOIN phrase_sprache AS sprache ON etikett.sprache_2_id = sprache.sprache_id INNER JOIN phrase_sprachentext AS sprachentext ON sprache.sprache_id = sprachentext.sprache_id GROUP BY u2 ) AS t2
ON t1.u1 = t2.u2";
		//$this is a reference of this class as well as Db
		$result = $this->connect2()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	//////////////////////////phrases

	public function selectFirstPhrasetext($phrasencode,$language1)
	{
		$sql = "SELECT phrasenkopf_id AS u1, sprache_id AS lang1, phrasencode AS pcode1, phrasentext AS ptext1 FROM phrase_phrasentext WHERE phrasencode = :phrasencode  AND sprache_id = :language1 GROUP BY pcode1";

		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":phrasencode",$phrasencode);
		$stmt->bindValue(":language1",$language1);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;


	}

	public function selectSecondPhrasetext($phrasencode,$language2)
	{
		$sql = "SELECT phrasenkopf_id AS u2, sprache_id AS lang2, phrasencode AS pcode2, phrasentext AS ptext2 FROM phrase_phrasentext WHERE phrasencode = :phrasencode AND sprache_id = :language2 GROUP BY pcode2";

		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":phrasencode",$phrasencode);
		$stmt->bindValue(":language2",$language2);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


public function selectPhrasetext($id)
	{
		
		$sql = "SELECT phrasencode, phrasentext FROM phrase_phrasentext WHERE phrasencode = :id and sprache_id = 15 and phrasencode != '' GROUP BY phrasencode";

		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function selectPhrasetext2($phrasencode,$language1,$language2)
	{
		
		$sql = "SELECT * FROM (SELECT phrasenkopf_id AS u1, sprache_id AS lang1, phrasencode AS pcode1, phrasentext AS ptext1 FROM phrase_phrasentext WHERE phrasencode = :phrasencode  AND sprache_id = :language1 ) AS t1 INNER JOIN (SELECT phrasenkopf_id AS u2, sprache_id AS lang2, phrasencode AS pcode2, phrasentext AS ptext2 FROM phrase_phrasentext WHERE phrasencode = :phrasencode AND sprache_id = :language2 ) AS t2 ON t1.u1 = t2.u2 GROUP BY t1.pcode1";

		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":phrasencode",$phrasencode);
		$stmt->bindValue(":language1",$language1);
		$stmt->bindValue(":language2",$language2);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function selectLanguage($lang)
	{
		$sql = "SELECT sprache_iso2 AS lang FROM phrase_sprache WHERE sprache_id = :lang";
		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":lang",$lang);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function selectSignalWord($lang,$head)
	{
		$sql = "SELECT phrasentext FROM phrase_phrasentext WHERE sprache_id = :lang AND phrasenkopf_id = :head";
		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":lang",$lang);
		$stmt->bindValue(":head",$head);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	

	public function readSignalWord($signalword, $language1, $language2)
	{
		//7091 = Danger
		//7093 = Warning

		if($signalword == 'D')
		{
			$sql = "SELECT * FROM (SELECT phrasenkopf_id, phrasentext AS phrasetext1, sprache_id FROM phrase_phrasentext WHERE phrasenkopf_id = 7091 AND sprache_id = :language1) AS t1 INNER JOIN (SELECT phrasenkopf_id, phrasentext AS phrasetext2, sprache_id FROM phrase_phrasentext WHERE phrasenkopf_id = 7091 AND sprache_id = :language2) AS t2 ON t1.phrasenkopf_id = t2.phrasenkopf_id";
		}
		else if($signalword == 'W')
		{
			$sql = "SELECT * FROM (SELECT phrasenkopf_id, phrasentext AS phrasetext1, sprache_id FROM phrase_phrasentext WHERE phrasenkopf_id = 7093 AND sprache_id = :language1) AS t1 INNER JOIN (SELECT phrasenkopf_id, phrasentext AS phrasetext2, sprache_id FROM phrase_phrasentext WHERE phrasenkopf_id = 7093 AND sprache_id = :language2) AS t2 ON t1.phrasenkopf_id = t2.phrasenkopf_id";
		}

		

		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":language1",$language1);
		$stmt->bindValue(":language2",$language2);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}





/////////////////////////////////////////////////////////////////////////38.3 Certificate





public function certsList($uid)
	{
		if($_SESSION['user_role_id'] == '1' || $_SESSION['user_role_id'] == '2')
		{
				$sql = "SELECT * FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id WHERE tb_battery_cert.del_status IS NULL AND tb_companies.company_id = ".$uid;
		}
		else
		{
				$sql = "SELECT * FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id WHERE tb_battery_cert.del_status IS NULL";
		}

		


		
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}


	public function certsListPerUser($uid)
	{
		$sql = "SELECT * FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id  WHERE tb_battery_cert.del_status IS NULL AND tb_users.user_id=".$uid;
		//$this is a reference of this class as well as Db
		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0)
		{
			//
			while ($row = $result->fetch())
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	public function countAllCerts()
	{
		
		$sql = "SELECT COUNT(*) AS allCerts FROM tb_battery_cert";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	public function readCertInfo($id)
	{
		
		$sql = "SELECT tb_battery_cert.battery_cert_id, tb_battery_cert.prod_name, 	tb_battery_cert.batt_name, tb_battery_cert.batt_category, tb_battery_cert.batt_type, tb_battery_cert.batt_lithium_content, tb_battery_cert.batt_watthour_rating, tb_battery_cert.batt_weight, tb_battery_cert.batt_cellsPerBatt, tb_battery_cert.cells_batt_per_device, tb_battery_cert.batt_supplier, tb_battery_cert.batt_cert, CONCAT(f_name, ' ', l_name) AS name, tb_companies.company_id, tb_companies.company_name FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id INNER JOIN tb_companies ON tb_users.company_id = tb_companies.company_id  WHERE tb_battery_cert.battery_cert_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function readCertInfoNoCompany($id)
	{
		
		$sql = "SELECT tb_battery_cert.battery_cert_id, tb_battery_cert.prod_name, 	tb_battery_cert.batt_name, tb_battery_cert.batt_category, tb_battery_cert.batt_type, tb_battery_cert.batt_lithium_content, tb_battery_cert.batt_watthour_rating, tb_battery_cert.batt_weight, tb_battery_cert.batt_cellsPerBatt, tb_battery_cert.cells_batt_per_device, tb_battery_cert.batt_supplier, tb_battery_cert.batt_cert, CONCAT(f_name, ' ', l_name) AS name FROM tb_battery_cert INNER JOIN tb_users ON tb_battery_cert.user_id = tb_users.user_id  WHERE tb_battery_cert.battery_cert_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	public function selectBatteryCert($id)
	{
		
		$sql = "SELECT batt_cert FROM tb_battery_cert WHERE battery_cert_id = :id";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindValue(":id",$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	

///////////////////////////////////////////////////////////////////////////end 38.3 certificate	



///////////////////////DELETE METHOD////////////////////
public function delete($fields,$id,$table_name,$whereClause)
	{
		$st = "";
		$counter = 1;
		$total_fields = count($fields);
		foreach ($fields as $key => $value) {
			if($counter === $total_fields)
			{
				$set = "$key = :".$key;
				$st = $st.$set;
			}
			else
			{
				$set = "$key = :".$key.", ";
				$st = $st.$set;
				$counter++;
			}
		}

		$sql ="";
		$sql.="UPDATE ".$table_name;
		$sql.=" SET ".$st;
		$sql.=" WHERE ".$whereClause;
		$sql.=" = ".$id;

		$stmt = $this->connect()->prepare($sql);

		foreach ($fields as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		
		}
		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
		}
		else
		{
			return 0;
		}


	}
    
public function deleteBlog($fields,$id,$table_name,$whereClause)
	{
		$st = "";
		$counter = 1;
		$total_fields = count($fields);
		foreach ($fields as $key => $value) {
			if($counter === $total_fields)
			{
				$set = "$key = :".$key;
				$st = $st.$set;
			}
			else
			{
				$set = "$key = :".$key.", ";
				$st = $st.$set;
				$counter++;
			}
		}

		$sql ="";
		$sql.="UPDATE ".$table_name;
		$sql.=" SET ".$st;
		$sql.=" WHERE ".$whereClause;
		$sql.=" = ".$id;

		$stmt = $this->connectBlogs()->prepare($sql);

		foreach ($fields as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		
		}
		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
		}
		else
		{
			return 0;
		}


	}

/////////////////////END DELETE METHOD///////////////


////////////////////ADD METHOD///////////////////////
	public function insert($fields,$table_name)
	{
	$implodeColumns = implode(', ',array_keys($fields));
	$implodePlaceholder = implode(", :", array_keys($fields));
	//$sql = "INSERT INTO tb_companies ($implodeColumns) VALUES (:".$implodePlaceholder.")";

	$sql = "";
	$sql.="INSERT INTO ".$table_name;
	$sql.=" (".$implodeColumns.") ";
	$sql.="VALUES (:".$implodePlaceholder.")";

	$stmt = $this->connect()->prepare($sql);

		foreach ($fields as $key => $value) {
			$stmt->bindValue(':'.$key,$value);
		}

		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
			
		}
		else
		{
			return 0;
		}


	}
	
////////////////////END ADD METHOD///////////////////


///////////////////UPDATE METHOD ///////////////////
public function update($fields,$id,$table_name,$whereClause)
	{
		$st = "";
		$counter = 1;
		$total_fields = count($fields);
		foreach ($fields as $key => $value) {
			if($counter === $total_fields)
			{
				$set = "$key = :".$key;
				$st = $st.$set;
			}
			else
			{
				$set = "$key = :".$key.", ";
				$st = $st.$set;
				$counter++;
			}
		}

		$sql ="";
		$sql.="UPDATE ".$table_name;
		$sql.=" SET ".$st;
		$sql.=" WHERE ".$whereClause;
		$sql.=" = ".$id;

		$stmt = $this->connect()->prepare($sql);

		foreach ($fields as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		
		}
		$stmtExec = $stmt->execute();

		if ($stmtExec) {
			return 1;
		}
		else
		{
			return 0;
		}


	}

/////////////////END UPDATE METHOD ////////////////
///////////////////////////////////////////////////
	public function checkPhrasencodeIfExist($phrasecode,$phrasetext)
    {
    	if(is_null($phrasecode))
    	{
    		$phrasetext = str_replace('-', '', $phrasetext);
    		
    	}
    	else
    	{
    		 if(trim($phrasetext) == '-')
    		{
        
        	$phrasetext = $phrasecode." - No available phrasetext for this language!";
   	 		}
    		else
    		{
        
        	$phrasetext = $phrasetext;
    		}
    	}
        
        
        return $phrasetext;

    }


    public function checkSignalwordIfExist($signalword)
    {
    	if(empty($signalword))
    	{
    		$signalword = "No signal word available for this language!";
    	}

    	return $signalword;


    }

    public function checkUnNumberIfExist($unNumber)
    {
    	if(empty($unNumber))
    	{
    		$unNumber = "NONE";
    	}

    	return $unNumber;

    }

    public function checkReachNumberIfExist($reachNumber)
    {
    	if(empty($reachNumber))
    	{
    		$reachNumber = "NONE";
    	}

    	return $reachNumber;

    }

    public function checkUfiNumberIfExist($ufiNumber)
    {
    	if(empty($ufiNumber))
    	{
    		$ufiNumber = "NONE";
    	}

    	return $ufiNumber;

    }


    public function selectLanguagetext($lcode)
    {
    	$sql = "SELECT phrase_sprache.sprache_id, phrase_sprache.sprache_iso2, phrase_sprachentext.sprachentext AS langText FROM phrase_sprache INNER JOIN phrase_sprachentext ON phrase_sprache.sprache_id = phrase_sprachentext.sprache_id WHERE phrase_sprachentext.anzeigesprache_id = 15 AND phrase_sprache.sprache_id = :lcode";

		$stmt = $this->connect2()->prepare($sql);
		$stmt->bindValue(":lcode",$lcode);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
    }

}