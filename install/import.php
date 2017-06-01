<?php 

    if(file_exists("ok.lock")){
        echo "程序已经安装过";
        echo "<br>";
        echo "重新安装请删除,install 文件夹下的 <font color='red'>ok.lock</font> 文件";
        exit;
    }

    header('Content-type: text/html; charset=utf-8');
    @set_time_limit(0);
    @set_magic_quotes_runtime(0);
    ob_end_flush();
    ob_implicit_flush(true);
    
    class mysql {
    private $DB;
    private $DBT = '';
    function __construct($host,$user,$pass,$dbtable){
        if(function_exists('mysqli_query')){
            $this->DB = new mysqli($host,$user,$pass,$dbtable);
            $this->DB->query("set names utf8");
            $this->DBT = 'mysqli';
        }else{
            $this->DB = mysql_connect($host,$user,$pass);
            mysql_select_db($dbtable,$this->DB);
            mysql_query("set names utf8");
            $this->DBT = 'mysql';
        }
        
        if(!$this->DB){
            echo "数据库连接失败";exit;
        }
    }
    
    function query($sql){
        if($this->DBT == 'mysqli'){
            return $this->DB->query($sql);
        }else{
            return mysql_query($sql,$this->DB);
        }
    }

}


$action = isset($_POST['action']) ? $_POST['action'] : null;
$proces = array();

//数据库连接
if($action == 'connect'){   
    $con =  @mysql_connect($_POST['host'],$_POST['user'],$_POST['pass']);
    if(!$con){
        $proces['msg']="数据库链接错误！";
        $proces['status']=0;
    }
    else if(!mysql_select_db($_POST['table'],$con)){
        $proces['msg']="数据库不存在！";
        $proces['status']=0;      
    }
    else{
         $proces['msg']="连接成功！";
         $proces['status']=1;  
    }  
    exit(json_encode($proces));
}


//导入数据库
if($_GET['action'] == 'import'){
    $host = $_GET['host'];
    $user = $_GET['user'];
    $pass = $_GET['pass'];
    $table = $_GET['table'];
    $type = $_GET['sqltype'];   //数据库连接模式
    $data = $_GET['ceshidata']; //安装测试数据
    $code = $_GET['code'];      //授权代码
    $prefix = $_GET['prefix'];
    
        
    $admin_user = $_GET['admin_user'];
    $admin_pass = $_GET['admin_pass'];  
    $admin_pass= md5(md5(trim($admin_pass)));
    
    
    $sql_arr = open_sql($prefix);
    $sql_arr[] = "INSERT INTO `".$prefix."admin` (gid,username,userpass) VALUES ('1','$admin_user','$admin_pass')";
        
    $number = count($sql_arr);
    $error_num = $ok_num = $i= 0;
    
    
    $db = new mysql($host,$user,$pass,$table);
    
    foreach($sql_arr as $sql){
        $sql = trim($sql);      
        $i++;
        $vaifenbi = ceil(($i/$number)*100).'%';
        if (!empty($sql) && strlen($sql) != 2){ 
            if(!$db->query($sql)){      
                echo "<div><i>{$vaifenbi}</i><p>sql执行失败,进度 {$vaifenbi}</p>";
                file_put_contents("error_sql.php",$sql.PHP_EOL,FILE_APPEND);
                $error_num++;
            }else{              
                echo "<div><i>{$vaifenbi}</i><p>sql执行成功,进度 {$vaifenbi}</p>";
                $ok_num++;
            }   
        }
        usleep(100000);
    }
        
    config_database($host,$user,$pass,$table,$prefix,$type);
    
    usleep(100000);
    
    if(!empty($code)){      
        file_put_contents('../system/config/code.inc.php',"<?php return array('code'=>'$code'); ?>");       
    }   
    
    usleep(100000);
    file_put_contents("ok.lock",$text); 
    
    echo $text = "<div><i>101%</i><p>共: {$number} 条,成功: {$ok_num} 条,失败: {$error_num} 条.</p>";
    
}   


//整理SQL
function open_sql($prefix){
    $sql = file_get_contents("install.sql");    
    $sql = str_replace('####_',$prefix,$sql);   
    return $sql = preg_split("/;[\r\n]/",$sql);

}
//配置MYSQL文件
function config_database($host,$user,$pass,$table,$prefix,$type){
    $config_file='../system/config/database.inc.php';   
    $con ="<?php".PHP_EOL;
    $con .= "return array(".PHP_EOL;
        $con .= "'default' => array (".PHP_EOL;
            $con .= "'hostname' => '".$host."',";
            $con .= "'database' => '".$table."',";                
            $con .= "'username' => '".$user."',";
            $con .= "'password' => '".$pass."',";
            $con .= "'tablepre' => '".$prefix."',";
            $con .= "'charset' => 'utf8',";
            $con .= "'type' => '".$type."',";
            $con .= "'debug' => false,";
            $con .= "'pconnect' => 0,";
            $con .= "'autoconnect' => 0";
        $con .= "),".PHP_EOL;
    $con .= ");";   
    file_put_contents($config_file,$con);
}



