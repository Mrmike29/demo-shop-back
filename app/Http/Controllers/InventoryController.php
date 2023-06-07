<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class InventoryController extends Controller
{
    public function all() {
        return DB::table('product AS PRO')
            ->leftJoin('company AS COM', 'PRO.id_company', '=', 'COM.NIT')
            ->where('PRO.state', 'Active')
            ->select(
                'PRO.id',
                'PRO.name',
                'PRO.stock',
                'COM.name AS company'
            )->get();
    }

    public function send() {
        $sender = 'mrmike981229@gmail.com';
        $senderName = 'Admin';

        $recipient = 'michaelorejuelaramirez@gmail.com';

        $usernameSmtp = 'AKIAT4SSPCQPJOSPAAOZ';
        $passwordSmtp = 'BPL61Xq03Jg3MZrCNe3mkgJUjmyBIswS1QVzu56bC/iZ';

        $host ='email-smtp.us-east-2.amazonaws.com';
        $port = 587;

        $subject = "Test";

        $bodyText = "Testing";

        $bodyHtml = '<h1>Hi</h1>';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->setFrom($sender, $senderName);
            $mail->Username = $usernameSmtp;
            $mail->Password = $passwordSmtp;
            $mail->Host = $host;
            $mail->Port = $port;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->addAddress($recipient);
            
            // $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $bodyHtml;
            $mail->AltBody = $bodyText;
            $mail->send();

            echo "Email send", PHP_EOL;
        } catch (phpmailerExceoption $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $mail->ErrorInfo;
        }
    }
}

//yY#EgR1{
    // SMTP Username:
    // 
    // SMTP Password:
    // 
