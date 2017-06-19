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
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

namespace home\Logic;

use think\Model\RelationModel;


/**
 * 文章模板逻辑
 * Class ArticleLogic
 * @package Home\Logic
 */

class ArticleLogic extends RelationModel
{

	public function getSiteArticle(){
		$syscate =  M('ArticleCat')->where("cat_type  = 1")->select();
		foreach($syscate as $v){
			$cats .= $v['cat_id'].',';
		}
		$cats = trim($cats,',');
		$result = M('Article')->where("cat_id","in",$cats)->select();
		foreach ($result as $val){
			$arr[$val['cat_id']][] = $val;
		}
		
		foreach ($syscate as $v){
			$v['article'] = $arr[$v['cat_id']];
			$brr[] = $v;
		}
		return $brr;
	}
	
	public function getArticleDetail($article_id){
		$article = '';
		return $article;
	}
}