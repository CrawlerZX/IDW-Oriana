<?php

class ComponenteSSH {

    private $host;

    private $user;

    private $pass;

    private $port;

    private $conn = false;

    private $error;

    private $stream;

    private $stream_timeout = 100;

    private $log;

    private $lastLog;
    
    public function __construct ( $host, $user, $pass, $port) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;

        if ( $this->connect ()->authenticate () ) {
            return true;
        }
    }

    public function __get ( $name ) {
        return $this->$name;
    }

    public function connect () {
        if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
        if ( $this->conn = ssh2_connect ( $this->host, $this->port ) ) {
            return $this;
        }
        return false;
    }

    public function authenticate () {
        if ( ssh2_auth_password ( $this->conn, $this->user, $this->pass ) ) {
            return $this;
        }
        return false;
    }

    public function sendFile ( $localFile, $remoteFile, $permision = 0644 ) {
        if ( ! is_file ( $localFile ) ){
            return "Erro ao enviar arquivo";
        };
        
        $sftp = ssh2_sftp ( $this->conn );
        $sftpStream = @fopen ( 'ssh2.sftp://' . $sftp . $remoteFile, 'w' );
        if ( ! $sftpStream ) {
            //  if 1 method failes try the other one
            if ( ! @ssh2_scp_send ( $this->conn, $localFile, $remoteFile, $permision ) ) {
                echo "Could not open remote file: $remoteFile";
            }
            else {
                return true;
            }
        }

        $data_to_send = @file_get_contents ( $localFile );

        if ( @fwrite ( $sftpStream, $data_to_send ) === false ) {
            echo "Could not send data from file: $localFile.";
        }

        fclose ( $sftpStream );

        echo "Sending file $localFile as $remoteFile succeeded";
        return true;
    }

    public function getFile ( $remoteFile, $localFile ) {
        echo "Receiving file $remoteFile as $localFile";
        if ( ssh2_scp_recv ( $this->conn, $remoteFile, $localFile ) ) {
            return true;
        }
        echo "Receiving file $remoteFile as $localFile failed";
    }

    public function cmd ( $cmd, $returnOutput = true ) {
        echo "Executing command $cmd";
        $this->stream = ssh2_exec ( $this->conn, $cmd );

        if ( FALSE === $this->stream ) {
            return "Unable to execute command $cmd";
        }
        echo "$cmd was executed";

        stream_set_blocking ( $this->stream, true );
        stream_set_timeout ( $this->stream, $this->stream_timeout );
        $this->lastLog = stream_get_contents ( $this->stream );

        echo "$cmd output: {$this->lastLog}";
        fclose ( $this->stream );
        $this->log .= $this->lastLog . "\n";
        return ( $returnOutput ) ? $this->lastLog : $this;
    }

    public function shellCmd ( $cmds = array () ) {
        echo "Openning ssh2 shell";
        $this->shellStream = ssh2_shell ( $this->conn );

        sleep ( 1 );
        $out = '';
        while ( $line = fgets ( $this->shellStream ) ) {
            $out .= $line;
        }

        echo "ssh2 shell output: $out";

        foreach ( $cmds as $cmd ) {
            $out = '';
            echo "Writing ssh2 shell command: $cmd";
            fwrite ( $this->shellStream, "$cmd" . PHP_EOL );
            sleep ( 1 );
            while ( $line = fgets ( $this->shellStream ) ) {
                $out .= $line;
                sleep ( 1 );
            }
            echo "ssh2 shell command $cmd output: $out";
        }

        echo "Closing shell stream";
        fclose ( $this->shellStream );
    }

    public function getLastOutput () {
        return $this->lastLog;
    }

    public function getOutput () {
        return $this->log;
    }

    public function disconnect () {
        echo "Disconnecting from {$this->host}";
        // if disconnect function is available call it..
        if ( function_exists ( 'ssh2_disconnect' ) ) {
            ssh2_disconnect ( $this->conn );
        }
        else { // if no disconnect func is available, close conn, unset var
            @fclose ( $this->conn );
            $this->conn = false;
        }
        // return null always
        return NULL;
    }

    public function fileExists ( $path ) {
        $output = $this->cmd ( "[ -f $path ] && echo 1 || echo 0", true );
        return ( bool ) trim ( $output );
    }
}