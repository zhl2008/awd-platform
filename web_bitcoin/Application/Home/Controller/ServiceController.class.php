<?php
/**
 * Created by PhpStorm.
 * User: deliang
 * Date: 10/14/16
 * Time: 8:33 AM
 */
namespace Home\Controller;

class ServiceController extends HomeController
{
    
    public function ourService()
    {
        $indexArticleType = (APP_DEBUG ? null : S('index_indexArticleType'));
        if (!$indexArticleType) {
            $indexArticleType = M('ArticleType')->where(array('status' => 1, 'index' => 1))->order('sort asc ,id desc')->limit(3)->select();
            S('index_indexArticleType', $indexArticleType);
        }
        $this->assign('indexArticleType', $indexArticleType);

        $indexArticle = (APP_DEBUG ? null : S('index_indexArticle'));
        if (!$indexArticle) {
            foreach ($indexArticleType as $k => $v) {
                $indexArticle[$k] = M('Article')->where(array('type' => $v['name'], 'status' => 1, 'index' => 1))->order('id desc')->limit(6)->select();
            }

            S('index_indexArticle', $indexArticle);
        }
        $this->assign('indexArticle', $indexArticle);

        $this->display();
    }

}