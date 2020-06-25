<?php
header("Content-type:text/html;charset=utf-8"); 
//数据类型是utf-8 不加入可能会乱码
	$serverName = "w.rdc.sae.sina.com.cn";	// 服务器ip
    $username = "4nox0om131";			// mysql用户名称
    $password = "k2jxi4x33z554khy1k0w2mh003lyhl3miyj5j5yl";		// 密码
    $dataBase = "app_994997";		// 数据库名称

    $conn = new mysqli($serverName,$username,$password,$dataBase);

    if($conn->connect_error) 
    {
    	//连接失败
        echo "对不起，服务器未响应";
        echo "<br>";
    }
    // 数据库数据编码格式
    $sql = "SET NAMES UTF8";
    if($conn->query($sql) === true)
     {
        //echo "set success<br>";
    }
    else 
    {
       echo "set fail<br>";
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
	//echo $username." ".$password;
    $result = array();

    if($username == "") 
    {
        $result["result"] = "false";
    }
    else 
    {
        $add = $conn->prepare("INSERT INTO userInformation(username,password)  VALUES(?,?)");
        $add->bind_param("ss", $username,$password);

        $stmt = $conn->prepare("SELECT * FROM userInformation WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);


        if($stmt->fetch()) 
        {
            $result["result"] = "false";
        }
        else
        {
            $add->execute();
            $result["result"] = "true";
        }
    }
    //echo json_encode($result);
?>

