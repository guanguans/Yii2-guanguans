<?php
use backend\models\Category;
use mdm\admin\models\Menu;
use backend\helper\Tree;
use yii\helpers\Url;
/**
 * 获取当前登录的前台用户的信息，未登录时，返回false
 * @return array|boolean
 */
function sp_get_current_user(){
    $session_user=session('user');
	if(!empty($session_user)){
		return $session_user;
	}else{
		return false;
	}
}

/**
 * 获取客户端ip
 * @return string
 */
function get_client_ip(){
    global $ip;
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else $ip = "0.0.0.0";
    return $ip;
}

/**
 * 获取系统信息
 * @return array
 */
function system_info(){
    // $mysql= \DB::select("select VERSION() as version");
    $mysql = \Yii::$app->db->createCommand("SELECT VERSION() AS version")->queryAll();
    $mysql = $mysql[0]['version'];
    $system_info = array(
		'操作系统'    => PHP_OS,
		'运行环境'    =>  $_SERVER["SERVER_SOFTWARE"],
		'PHP版本'   => PHP_VERSION,
		'PHP版本'   => phpversion(),
		'PHP运行方式' => php_sapi_name(),
		'MYSQL版本' =>$mysql,
		'上传附件限制'  => ini_get('upload_max_filesize'),
		'执行时间限制'  => ini_get('max_execution_time') . "s",
		'剩余空间'    => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
    );
    return $system_info;
}

/**
 * 发送邮件
 * @return string
 */
function send_email($object, $title, $content){
	$mail= Yii::$app->mailer->compose();
	$mail->setTo($object);
	$mail->setSubject($title);
	// $mail->setTextBody($object);
	$mail->setHtmlBody($content);

	if(!$mail->send()){
		return false;
	}

	return true;
}

/**
 * 获取操作提示信息
 * @param object|''
 * @return string
 */
function hintInfo($info, $model=''){
	if ($model) {
		$errors = $model->getErrors();
	    $err = '';
	    foreach ($errors as $v) {
	        $err .= $v[0] . '<br>';
	    }
	    $info = [
			'code' => 0,
			'data' => $err,
		];
	}
	yii::$app->session->setFlash('info', json_encode($info));
}

/**
 * @param int|array $currentIds
 * @param string $tpl
 * @return string
 */
function dataTree($currentIds = 0, $tpl = '')
{
    $categories = Menu::find()
                ->orderBy('order ASC')
                ->asArray()
                ->all();

    $tree       = new Tree();
    if (!is_array($currentIds)) {
        $currentIds = [$currentIds];
    }

    $newCategories = [];
    foreach ($categories as $item) {
    	$item['parent_id'] = $item['parent'];
        array_push($newCategories, $item);
    }

    $tree->init($newCategories);
    $treeStr = $tree->getTreeArray(0);

    return $treeStr;
}

/**
 * @param int|array $currentIds
 * @param string $tpl
 * @return string
 */
function menuTree($currentIds = 0, $tpl = '')
{
	$data = dataTree();

	foreach ($data as $k => $vo) {



	}

    return $treeStr;
}




/**
 * @param int|array $currentIds
 * @param string $tpl
 * @return string
 */
function categoryTableTree($currentIds = 0, $tpl = '')
{
    $categories = Category::find()
                ->orderBy('sort ASC')
                ->asArray()
                ->all();
    $tree       = new Tree();
    $tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
    $tree->nbsp = '&nbsp;&nbsp;';

    if (!is_array($currentIds)) {
        $currentIds = [$currentIds];
    }

    $newCategories = [];
    foreach ($categories as $item) {
        $item['checked'] = in_array($item['id'], $currentIds) ? "checked" : "";
        $item['url']     = Url::to(['category/index', 'id' => $item['id']]);

        $item['str_action'] = '<a href="' . Url::to(['category/create', 'parent_id' => $item['id']]) . '">添加子分类</a> | <a href="' . Url::to(['category/view', 'id' => $item['id']]) . '">查看</a> | <a href="' . Url::to(['category/update', 'id' => $item['id']]) . '">编辑</a>  | <a class="text-danger" data-pjax="0"  data-confirm="您确定要删除此项吗？" data-method="post" href="' . Url::to(['category/delete', 'id' => $item['id']]) . '">删除</a> ';
        array_push($newCategories, $item);
    }

    $tree->init($newCategories);

    if (empty($tpl)) {
        $tpl = "<tr>
                    <td><input name='list_orders[\$id]' type='text' size='3' value='\$sort' class='input-order'></td>
                    <td>\$id</td>
                    <td>\$spacer <a href='\$url' target='_blank'>\$name</a></td>
                    <td>\$remark</td>
                    <td width='230px'>\$str_action</td>
                </tr>";
    }
    $treeStr = $tree->getTree(0, $tpl);

    return $treeStr;
}

/**
 * 生成分类 select树形结构
 * @param int $selectId 需要选中的分类 id
 * @param int $currentCid 需要隐藏的分类 id
 * @return string
 */
function categoryTree($selectIds = [], $currentCid = 0)
{
	$where = [];
    if (!empty($currentCid)) {
        $where['id'] = ['neq', $currentCid];
    }
    $categories = Category::find()
    			->where($where)
                ->orderBy('sort ASC')
                ->asArray()
                ->all();

    $tree       = new Tree();
    $tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
    $tree->nbsp = '&nbsp;&nbsp;';

    $newCategories = [];
    foreach ($categories as $item) {
        // $item['selected'] = $selectId == $item['id'] ? "selected" : "";
        $item['selected'] = in_array($item['id'], $selectIds) ? "selected" : "";

        array_push($newCategories, $item);
    }

    $tree->init($newCategories);
    $str     = '<option value=\"{$id}\" {$selected}>{$spacer}{$name}</option>';
    $treeStr = $tree->getTree(0, $str);

    return $treeStr;
}

/**
 * 返回带协议的域名
 */
function sp_get_host(){
	$host=$_SERVER["HTTP_HOST"];
	$protocol=is_ssl()?"https://":"http://";
	return $protocol.$host;
}

/**
 * 打印数组对象
 */
function p($arr=''){
    echo '<pre>';
    var_dump($arr);
}

/**
 * 打印数组对象并停止
 */
function pp($arr=''){
    echo '<pre>';
    print_r($arr);
    exit;
}

/**
 * 密码加密方法
 * @param string $pw 要加密的字符串
 * AUTH_CODE=hItFe09RoXMvpBTs6TUyAZEbCmCocQKKIIuvO3N8emA
 * @return string
 */
function en_password($pw,$decor=''){
    if(empty($decor)){
        $decor=md5(env('AUTH_CODE'));
    }
    $mi=md5(md5($decor.$pw));
    $result = substr($decor,0,12).$mi.substr($decor,-4,4);
	return $result;
}

/**
 * 密码加密方法 (X2.0.0以前的方法)
 * @param string $pw 要加密的字符串
 * @return string
 */
function en_password_old($pw){
    $decor=md5(C('DB_PREFIX'));
    $mi=md5($pw);
    return substr($decor,0,12).$mi.substr($decor,-4,4);
}

/**
 * 密码比较方法,所有涉及密码比较的地方都用这个方法
 * @param string $password 要比较的密码
 * @param string $password_in_db 数据库保存的已经加密过的密码
 * @return boolean 密码相同，返回true
 */
function sp_compare_password($password,$password_in_db){
    if(strpos($password_in_db, "###")===0){
        return sp_password($password)==$password_in_db;
    }else{
        return sp_password_old($password)==$password_in_db;
    }
}

/**
 * 随机字符串生成
 * @param int $len 生成的字符串长度
 * @return string
 */
function sp_random_string($len = 6) {
	$chars = array(
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
			"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
			"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
			"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
			"S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
			"3", "4", "5", "6", "7", "8", "9"
	);
	$charsLen = count($chars) - 1;
	shuffle($chars);    // 将数组打乱
	$output = "";
	for ($i = 0; $i < $len; $i++) {
		$output .= $chars[mt_rand(0, $charsLen)];
	}
	return $output;
}

/**
 * 清空系统缓存，兼容sae
 */
function sp_clear_cache(){
		import ( "ORG.Util.Dir" );
		$dirs = array ();
		// runtime/
		$rootdirs = sp_scan_dir( RUNTIME_PATH."*" );
		//$noneed_clear=array(".","..","Data");
		$noneed_clear=array(".","..");
		$rootdirs=array_diff($rootdirs, $noneed_clear);
		foreach ( $rootdirs as $dir ) {

			if ($dir != "." && $dir != "..") {
				$dir = RUNTIME_PATH . $dir;
				if (is_dir ( $dir )) {
					//array_push ( $dirs, $dir );
					$tmprootdirs = sp_scan_dir ( $dir."/*" );
					foreach ( $tmprootdirs as $tdir ) {
						if ($tdir != "." && $tdir != "..") {
							$tdir = $dir . '/' . $tdir;
							if (is_dir ( $tdir )) {
								array_push ( $dirs, $tdir );
							}else{
								@unlink($tdir);
							}
						}
					}
				}else{
					@unlink($dir);
				}
			}
		}
		$dirtool=new \Dir("");
		foreach ( $dirs as $dir ) {
			$dirtool->delDir ( $dir );
		}

		if(sp_is_sae()){
			$global_mc=@memcache_init();
			if($global_mc){
				$global_mc->flush();
			}

			$no_need_delete=array("THINKCMF_DYNAMIC_CONFIG");
			$kv = new SaeKV();
			// 初始化KVClient对象
			$ret = $kv->init();
			// 循环获取所有key-values
			$ret = $kv->pkrget('', 100);
			while (true) {
				foreach($ret as $key =>$value){
                    if(!in_array($key, $no_need_delete)){
                    	$kv->delete($key);
                    }
                }
				end($ret);
				$start_key = key($ret);
				$i = count($ret);
				if ($i < 100) break;
				$ret = $kv->pkrget('', 100, $start_key);
			}

		}

}

/**
 * 保存数组变量到php文件
 * @param string $path 保存路径
 * @param mixed $value 要保存的变量
 * @return boolean 保存成功返回true,否则false
 */
function sp_save_var($path,$value){
	$ret = file_put_contents($path, "<?php\treturn " . var_export($value, true) . ";?>");
	return $ret;
}

/**
 * 转化格式化的字符串为数组
 * @param string $tag 要转化的字符串,格式如:"id:2;cid:1;order:post_date desc;"
 * @return array 转化后字符串<pre>
 * array(
 *  'id'=>'2',
 *  'cid'=>'1',
 *  'order'=>'post_date desc'
 * )
 */

function sp_param_lable($tag = ''){
	$param = array();
	$array = explode(';',$tag);
	foreach ($array as $v){
		$v=trim($v);
		if(!empty($v)){
			list($key,$val) = explode(':',$v);
			$param[trim($key)] = trim($val);
		}
	}
	return $param;
}

/**
 * 去除字符串中的指定字符
 * @param string $str 待处理字符串
 * @param string $chars 需去掉的特殊字符
 * @return string
 */
function sp_strip_chars($str, $chars='?<*.>\'\"'){
	return preg_replace('/['.$chars.']/is', '', $str);
}

/**
 * 发送邮件
 * @param string $address
 * @param string $subject
 * @param string $message
 * @return array<br>
 * 返回格式：<br>
 * array(<br>
 * 	"error"=>0|1,//0代表出错<br>
 * 	"message"=> "出错信息"<br>
 * );
 */
function sp_send_email($address,$subject,$message){
	$mail=new \PHPMailer();
	// 设置PHPMailer使用SMTP服务器发送Email
	$mail->IsSMTP();
	$mail->IsHTML(true);
	// 设置邮件的字符编码，若不指定，则为'UTF-8'
	$mail->CharSet='UTF-8';
	// 添加收件人地址，可以多次使用来添加多个收件人
	$mail->AddAddress($address);
	// 设置邮件正文
	$mail->Body=$message;
	// 设置邮件头的From字段。
	$mail->From=C('SP_MAIL_ADDRESS');
	// 设置发件人名字
	$mail->FromName=C('SP_MAIL_SENDER');;
	// 设置邮件标题
	$mail->Subject=$subject;
	// 设置SMTP服务器。
	$mail->Host=C('SP_MAIL_SMTP');
	//by Rainfer
	// 设置SMTPSecure。
	$Secure=C('SP_MAIL_SECURE');
	$mail->SMTPSecure=empty($Secure)?'':$Secure;
	// 设置SMTP服务器端口。
	$port=C('SP_MAIL_SMTP_PORT');
	$mail->Port=empty($port)?"25":$port;
	// 设置为"需要验证"
	$mail->SMTPAuth=true;
	// 设置用户名和密码。
	$mail->Username=C('SP_MAIL_LOGINNAME');
	$mail->Password=C('SP_MAIL_PASSWORD');
	// 发送邮件。
	if(!$mail->Send()) {
		$mailerror=$mail->ErrorInfo;
		return array("error"=>1,"message"=>$mailerror);
	}else{
		return array("error"=>0,"message"=>"success");
	}
}

/**
 * 获取文件下载链接
 * @param string $file
 * @param int $expires
 * @return string
 */
function sp_get_file_download_url($file,$expires=3600){
    if(C('FILE_UPLOAD_TYPE')=='Qiniu'){
        $storage_setting=sp_get_cmf_settings('storage');
        $qiniu_setting=$storage_setting['Qiniu']['setting'];
        $filepath=$qiniu_setting['protocol'].'://'.$storage_setting['Qiniu']['domain']."/".$file;
        $url=sp_get_asset_upload_path($file,false);

        if($qiniu_setting['enable_picture_protect']){
            $qiniuStorage=new \Think\Upload\Driver\Qiniu\QiniuStorage(C('UPLOAD_TYPE_CONFIG'));
            $url = $qiniuStorage->privateDownloadUrl($url,$expires);
        }

        return $url;

    }else{
        return sp_get_asset_upload_path($file,false);
    }
}

/**
 * 判断是否为手机访问
 * @return  boolean
 */
function sp_is_mobile() {
	static $sp_is_mobile;

	if ( isset($sp_is_mobile) )
		return $sp_is_mobile;

	if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
		$sp_is_mobile = false;
	} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
			|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
		$sp_is_mobile = true;
	} else {
		$sp_is_mobile = false;
	}

	return $sp_is_mobile;
}

/**
 * 判断是否为微信访问
 * @return boolean
 */
function sp_is_weixin(){
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    }
    return false;
}


/**
 * 替代scan_dir的方法
 * @param string $pattern 检索模式 搜索模式 *.txt,*.doc; (同glog方法)
 * @param int $flags
 */
function sp_scan_dir($pattern,$flags=null){
	$files = array_map('basename',glob($pattern, $flags));
	return $files;
}

/**
 * 兼容之前版本的ajax的转化方法，如果你之前用参数只有两个可以不用这个转化，如有两个以上的参数请升级一下
 * @param array $data
 * @param string $info
 * @param int $status
 */
function sp_ajax_return($data,$info,$status){
	$return = array();
	$return['data'] = $data;
	$return['info'] = $info;
	$return['status'] = $status;
	$data = $return;

	return $data;
}

/**
 * 获取文件扩展名
 * @param string $filename
 */
function sp_get_file_extension($filename){
    $pathinfo=pathinfo($filename);
    return strtolower($pathinfo['extension']);
}
