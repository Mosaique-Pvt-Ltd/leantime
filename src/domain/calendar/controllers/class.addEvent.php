<?php

/**
 * newClient Class - Add a new client
 *
 */

namespace leantime\domain\controllers {

    use leantime\core;
    use leantime\domain\repositories;

    class addEvent
    {

        /**
         * run - display template and edit data
         *
         * @access public
         */
        public function run()
        {

            $mail = new core\mailer();
            $tpl = new core\template();
            $calendarRepo = new repositories\calendar();

            $userId = $_SESSION['userdata']['id'];
            $userRepo = new repositories\users();

            $userData = $userRepo->getUser($userId);


            $values = array(
                'description' => '',
                'dateFrom' => '',
                'dateTo' => '',
                'emailNote' => '',
                'emailNotification' => '',
                'allDay' => ''
            );

            if (isset($_POST['save']) === true) {

                if (isset($_POST['allDay']) === true) {
                    $allDay = 'true';
                } else {
                    $allDay = 'false';
                }

                if (isset($_POST['emailNotification']) === true) {
                    $emailNotification = 'true';
                } else {
                    $emailNotification = 'false';
                }

                

                if (isset($_POST['dateFrom']) === true && isset($_POST['timeFrom']) === true) {
                    $dateFrom = date('Y-m-d H:i:01', strtotime($_POST['dateFrom']." ".$_POST['timeFrom']));
                }


                if (isset($_POST['dateTo']) === true && isset($_POST['timeTo']) === true) {
                    $dateTo = date('Y-m-d H:i:01', strtotime($_POST['dateTo']." ".$_POST['timeTo']));
                }

                $values = array(
                    'description' => ($_POST['description']),
                    'dateFrom' => $dateFrom,
                    'dateTo' => $dateTo,
                    'emailNote' => ($_POST['emailNote']),
                    'emailNotification' => $emailNotification,
                    'allDay' => $allDay
                );

                if ($values['description'] !== '') {

                    $calendarRepo->addEvent($values);

                    $tpl->setNotification('notification.event_created_successfully', 'success');

                } else {

                    $tpl->setNotification('notification.please_enter_title', 'error');

                }

                $tpl->assign('values', $values);

                // To send email on checking the text box
                if (isset($_POST['emailNotification']) === true) {
                    
                    $emailNotification = 'true';
                    $mail->setSubject('Your event reminder');
                    // $actual_link = "".BASE_URL."/resetPassword/".$resetLink;
                    $mail->setHtml(sprintf('Task: '.$values['description'].'<br> Note: '.$values['emailNote'].'<br> Start date: '.$values['dateFrom'].
                    '<br> End date: '.$values['dateTo'] ));

                    $to = array($userData['username']);
                
                    $mail->sendMail($to, "Leantime System");
                        
                } else {
                    $emailNotification = 'false';
                }
            }

            $tpl->assign('values', $values);
            $tpl->display('calendar.addEvent');

        }

    }
}
