<?php
	if(!isset($_POST['command'])){
		echo "";
	}else{
			ssh($_POST['command'], $_POST['config']);
	}
	
	function ssh($comando, $hostname = "192.168.20.177", $user = "osboxes", $password = "osboxes.org", $port = 22){
		if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
		// log in at server1.example.com on port 22
		if(!($connection = ssh2_connect($hostname, $port))){
		    echo "fail: unable to establish connection\n";
		} else {
		    // try to authenticate with username root, password secretpassword
		    if(!ssh2_auth_password($connection, $user, $password)) {
		        echo "fail: unable to authenticate\n";
		    } else {
		        // allright, we're in!
		        // execute a command
		        if (!($stream = ssh2_exec($connection, $comando))) {
		            echo "fail: unable to execute command\n";
		        } else {
		            // collect returning data from command
		            stream_set_blocking($stream, true);
		            $data = "";
		            while ($buf = fread($stream,4096)) {
		                $data .= $buf;
		            }
		            sleep(1);
		        }
		        if (!($stream = ssh2_exec($connection, "pwd"))) {
		        	echo "fail: unable to execute command\n";
		        } else {
		            stream_set_blocking($stream, true);
		            $retorno[0] = "";
		            while ($buf = fread($stream,4096)) {
		                $retorno[0] .= $buf;
		            }
		            fclose($stream);
		        }		        
		    }
		}
		$retorno[1] = $data;
		$retorno = json_encode($retorno);
		echo $retorno;
		return false;
	}	
?>





