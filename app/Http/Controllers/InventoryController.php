<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class InventoryController extends Controller
{
    // Get Products Inventory
    public function all() {
        return DB::table('product AS PRO')
            ->leftJoin('company AS COM', 'PRO.id_company', '=', 'COM.NIT')
            ->leftJoin('country AS COU', 'COM.id_country', '=', 'COU.id')
            ->where('PRO.state', 'Active')
            ->select(
                'PRO.id',
                'PRO.name',
                'PRO.stock',
                'COM.name AS company',
                'COU.local-currency AS currency' 
            )->get();
    }

    // Send email whit PDF
    public function send(Request $request) {
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

        $pdf = $request->file('pdf');

        // Save the PDF to a temporary file on the server
        $pdfPath = 'temp/pdf.pdf';
        $pdf->move(public_path('temp'), $pdfPath);
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
            $mail->addAttachment(public_path($pdfPath), 'pdf.pdf');
            $mail->send();

            return response()->json(['success' => true, 'message' => 'Email send']);
        } catch (phpmailerExceoption $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $mail->ErrorInfo;
        }
    }
}
