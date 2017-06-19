<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 当燃      
 * Date: 2015-09-17
 */

namespace app\admin\controller;

use common\util\File;
use think\log;
use think\Image;
use think\Request;
/**
 * Class UeditorController
 * @package Admin\Controller
 */
class Ueditor extends Base
{
    private $sub_name = array('date', 'Y/m-d');
    private $savePath = 'temp/';

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Shanghai");
        
        $this->savePath = I('GET.savepath','temp').'/';
        
        error_reporting(E_ERROR | E_WARNING);
    }
    
    public function getContent()
    {
        echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
            <script src="/tpshop/public/plugins/Ueditor/ueditor.parse.js" type="text/javascript"></script>
            <script>' . " uParse('.content',{
                  'highlightJsUrl':'/tpshop/public/plugins/Ueditor/third-party/SyntaxHighlighter/shCore.js',
                  'highlightCssUrl':/tpshop/public/plugins/Ueditor/third-party/SyntaxHighlighter/shCoreDefault.css'
              })</script>";
        $myEditor = $this->request->param('myEditor');
        $content = htmlspecialchars(stripslashes($myEditor));
        echo "<div class='content'>" . htmlspecialchars_decode($content) . "</div>";
    }

    /**
     *上传文件
     */
    public function fileUp()
    {
        $config = array(
            "savePath" => 'File/',
            "maxSize" =>  20000000, // 单位B
            "exts" => explode(",",  'zip,rar,doc,docx,zip,pdf,txt,ppt,pptx,xls,xlsx'),
            "subName" => $this->sub_name,
        );

        $upload = new Upload($config);
        $info = $upload->upload();

        if ($info) {
            $state = "SUCCESS";
        } else {
            $state = "ERROR" . $upload->getError();
        }

        $return_data['url'] = $info['upfile']['urlpath'];
        $return_data['fileType'] = $info['upfile']['ext'];
        $return_data['original'] = $info['upfile']['name'];
        $return_data['state'] = $state;
        $this->ajaxReturn($return_data,'JSON');
    }

    /**
     * 获取远程图片
     */
    public function getRemoteImage()
    {
        header("Content-Type: text/html; charset=utf-8");
        //远程抓取图片配置
        $config = array(
            "savePath" => UPLOAD_PATH . 'remote/' . date('Y') . '/' . date('m') . '/', //保存路径
            "allowFiles" => array(".gif", ".png", ".jpg", ".jpeg", ".bmp"), //文件允许格式
            "maxSize" => 20000000,
        );
        $upfile = $this->request->param('upfile');
        $uri = htmlspecialchars($upfile);
        $uri = str_replace("&amp;", "&", $uri);
        $this->getRemoteImage2($uri, $config);

    }

    /**
     * 远程抓取
     * @param $uri
     * @param $config
     */
    public function getRemoteImage2($uri, $config)
    {
        //忽略抓取时间限制
        set_time_limit(0);
        //ue_separate_ue  ue用于传递数据分割符号
        $imgUrls = explode("ue_separate_ue", $uri);
        $tmpNames = array();
        foreach ($imgUrls as $imgUrl) {
            //http开头验证
            if (strpos($imgUrl, "http") !== 0) {
                array_push($tmpNames, "https error");
                continue;
            }
            //sae环境 不兼容
            if (!defined('SAE_TMP_PATH')) {
                //获取请求头
                $heads = get_headers($imgUrl);
                //死链检测
                if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
                    array_push($tmpNames, "get_headers error");
                    continue;
                }
            }
            
            //格式验证(扩展名验证和Content-Type验证)
            $fileType = strtolower(strrchr($imgUrl, '.'));
            if (!in_array($fileType, $config['allowFiles']) || stristr($heads['Content-Type'], "image")) {
                array_push($tmpNames, "Content-Type error");
                continue;
            }

            //打开输出缓冲区并获取远程图片
            ob_start();
            $context = stream_context_create(
                array(
                    'http' => array(
                        'follow_location' => false // don't follow redirects
                    )
                )
            );
            //请确保php.ini中的fopen wrappers已经激活
            readfile($imgUrl, false, $context);
            $img = ob_get_contents();
            ob_end_clean();

            //大小验证
            $uriSize = strlen($img); //得到图片大小
            $allowSize = 1024 * $config['maxSize'];
            if ($uriSize > $allowSize) {
                array_push($tmpNames, "maxSize error");
                continue;
            }

            $savePath = $config['savePath'];

            if (!defined('SAE_TMP_PATH')) {
                //非SAE
                //创建保存位置
                if (!file_exists($savePath)) {
                    mkdir($savePath, 0777, true);
                }
                //写入文件
                $tmpName = $savePath . rand(1, 10000) . time() . strrchr($imgUrl, '.');
                try {
                    File::writeFile($tmpName, $img, "a");

                    array_push($tmpNames,  '/' . $tmpName);
                } catch (\Exception $e) {
                    array_push($tmpNames, "error");
                }
            } else {
                //SAE
                $Storage = new \SaeStorage();
                $domain = C('SaeStorage');
                $destFileName = 'remote/' . date('Y') . '/' . date('m') . '/' . rand(1, 10000) . time() . strrchr($imgUrl, '.');
                $result = $Storage->write($domain, $destFileName, $img, -1);
                Log::write('$destFileName:' . $destFileName);
                if ($result) {
                    array_push($tmpNames, $result);
                } else {
                    array_push($tmpNames, "not supported");
                }

            }

        }
        /**
         * 返回数据格式
         * {
         *   'url'   : '新地址一ue_separate_ue新地址二ue_separate_ue新地址三',
         *   'srcUrl': '原始地址一ue_separate_ue原始地址二ue_separate_ue原始地址三'，
         *   'tip'   : '状态提示'
         * }
         */
        $return_data['url'] = implode("ue_separate_ue", $tmpNames);
        $return_data['tip'] = '远程图片抓取成功！';
        $return_data['srcUrl'] = $uri;
        $this->ajaxReturn($return_data);
    }

    /**
     * 无需移植
     * @function getMovie
     */
    public function getMovie()
    {
        $key = C("tudouSearchKey");
        $type = I('post.videoType');
        $html = file_get_contents('http://api.tudou.com/v3/gw?method=item.search&appKey=myKey&format=json&kw=' .
        $key . '&pageNo=1&pageSize=20&channelId=' . $type . '&inDays=7&media=v&sort=s');
        echo $html;
    }

    /**
     * @function imageManager
     */
    public function imageManager()
    {

        header("Content-Type: text/html; charset=utf-8");
        //需要遍历的目录列表，最好使用缩略图地址，否则当网速慢时可能会造成严重的延时
        $paths = array(UPLOAD_PATH, 'upload1/');
        $action = $this->request->param('action');
        $action = htmlspecialchars($action);
        if ($action == "get") {
            if (!defined('SAE_TMP_PATH')) {
                $files = array();
                
                include_once 'application/common/util/File.class.php';                   
                foreach ($paths as $path) {
                    $tmp = File::getFiles($path);
                    if ($tmp) {
                        $files = array_merge($files, $tmp);
                    }
                }
                if (!count($files)) return;
                rsort($files, SORT_STRING);
                $str = "";
                foreach ($files as $file) {
                    $str .=  '/' . $file . "ue_separate_ue";
                }
                echo $str;
            } else {
                // SAE环境下
                $st = new \SaeStorage(); // 实例化
                /*
                *  getList:获取指定domain下的文件名列表
                *  return: 执行成功时返回文件列表数组，否则返回false
                *  参数：存储域，路径前缀，返回条数，起始条数
                */
                $num = 0;
                while ($ret = $st->getList(C('SaeStorage'), null, 100, $num)) {
                    foreach ($ret as $file) {
                        if (preg_match("/\.(gif|jpeg|jpg|png|bmp)$/i", $file))

                            echo $st->getUrl('upload', $file) . "ue_separate_ue";
                        $num++;
                    }
                }
            }
        }
    }

    /**
     * @function imageUp
     */
    public function imageUp()
    {       
        // 上传图片框中的描述表单名称，
        $pictitle = I('pictitle');
        $dir = I('dir');
        $title = htmlspecialchars($pictitle , ENT_QUOTES);        
        $path = htmlspecialchars($dir, ENT_QUOTES);
       
        //$input_file           ['upfile'] = $info['Filedata'];  一个是上传插件里面来的, 另外一个是 文章编辑器里面来的
        // 获取表单上传文件
        $file = request()->file('Filedata');

        
        if(empty($file))
            $file = request()->file('upfile');   

        //如果上传文件总是不成功 注意设置php.ini中的upload_tmp_dir与文件上传大小
        if(is_array($file)){
            if(!empty($file['Filedata'])){
                $aFileInfo = $file['Filedata'];
            }elseif(!empty($file['upfile'])){
                $aFileInfo = $file['upfile'];
            }else{
                $return_data['state'] = "ERROR上传文件信息错误!";
                $this->ajaxReturn($return_data,'json');
            }

            //判断文件大小是否超过限制
            if($aFileInfo['size'] > 20000000){
                $return_data['state'] = "ERROR上传文件大小超过上限!";
                $this->ajaxReturn($return_data,'json');
            }

            $result = true;
            $iFrom = 1;
        }else{
            $result = $this->validate(
                ['file2' => $file], 
                ['file2'=>'image','file2'=>'fileSize:20000000'],
                ['file2.image' => '上传文件必须为图片','file2.fileSize' => '上传文件过大']                
           );
            $iFrom = 2;
        }

        if(true !== $result){            
            $state = "ERROR" . $result;
        }elseif(!empty($aFileInfo) || !empty($file)){
            // 移动到框架应用根目录/public/upload/ 目录下
            if($iFrom == 1){
                $sPostFes = substr($aFileInfo['name'], strrpos($aFileInfo['name'], '.'));
                $sSaveFile = uniqid() . '_' . time() . $sPostFes;
                $this->savePath = $_SERVER['DOCUMENT_ROOT'] . '/tpshop/public/upload/' . $sSaveFile;
                        
                $info = move_uploaded_file($aFileInfo['tmp_name'], $this->savePath);  
            }else{
                $info = $file->rule(function ($file) {    
                     return  md5(mt_rand()); // 使用自定义的文件保存规则
                })->move('public/upload/');
                $sSaveFile = $info->getSaveName();
            }
                     
            if ($info) 
                $state = "SUCCESS";                         
            else 
                $state = "ERROR上传失败";

            $return_data['url'] = '/tpshop/public/upload/'. $sSaveFile;          
        }
        
        $return_data['title'] = $title;
        $return_data['original'] = ''; // 这里好像没啥用 暂时注释起来
        $return_data['state'] = $state;
        $return_data['path'] = $path;        
        //print_r($return_data);
        $this->ajaxReturn($return_data,'json');
    }
}