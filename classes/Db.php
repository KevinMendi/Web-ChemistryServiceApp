<?php

/**
 * 
 */
class Db 
{
	
	protected function connect()
	{
		//connection
		try {
    		$conn = new PDO("mysql:host=localhost;dbname=dbchemical_service;charset=UTF8", 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // set the PDO error mode to exception
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		//echo "Connected successfully";




    		return $conn;


    		}
		catch(PDOException $e)
    		{
    		echo "Connection failed: " . $e->getMessage();
    		}

	}

    protected function connect2()
    {
        //connection
        try {
            $conn2 = new PDO("mysql:host=localhost;dbname=db538199618;charset=UTF8", 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // set the PDO error mode to exception
            $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";

            return $conn2;
            

            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }

    }
    
    protected function connectBlogs()
    {
        try {
            $connBlogs = new PDO("mysql:host=localhost;dbname=chempo-blog;charset=UTF8", 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $connBlogs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $connBlogs;
        }
        catch (PDOException $e)
        {
            echo "Connection failed: ". $e->getMessage();
        }
    }


}



