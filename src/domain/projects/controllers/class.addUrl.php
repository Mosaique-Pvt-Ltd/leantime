<?php

/**
 * newClient Class - Add a new client
 *
 */

namespace leantime\domain\controllers {

    use leantime\core;
    use leantime\domain\repositories;

    class addUrl
    {

        /**
         * run - display template and edit data
         *
         * @access public
         */
        public function run()
        {
            
            $tpl = new core\template();
            $urlRepo = new repositories\projects();

            $values = array(
                'userId' => '',
                'title' => '',
                'url' => '',
                'comment' => ''
            );

            //To add the data to the zp_url table
            if (isset($_POST['add']) === true) {

                $values = array(
                    'userId' => core\login::getUserId(),
                    'title' => ($_POST['title']),
                    'url' => ($_POST['url']),
                    'comment' => ($_POST['comment'])
                );

                if ($values['title'] !== ''&& $values['url'] !== '') {
                    
                    $urlRepo->addUrl($values);

                } else {

                }

                $tpl->assign('values', $values);
            }

            $urlData= $urlRepo->getUrl($values['userId']);
            
            $tpl->assign('urlData', $urlData);
            
            $tpl->redirect(BASE_URL."/projects/showProject/".($_POST['id'])."#url");     

        }

    }
}
