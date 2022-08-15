<?php

use App\Mail\SendPasswordVerification;
use App\Models\EmailTemplate;
use App\Models\GeneralSetting;
use App\Models\Page;
use App\Models\SectionData;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendVerificationMail($email, $code)
{
    Mail::to($email)
        ->send(new SendPasswordVerification($code));
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}

function uploadImage($image, $path, $old = null)
{

    $isDirectoryMade = makeDirectory($path);

    if (!$isDirectoryMade) throw new Exception('Directory could not made');

    $filename = uniqid() . time() . '.' . $image->getClientOriginalExtension();



    if ($image->getClientOriginalExtension() == 'gif') {
        copy($image->getRealPath(), $path . '/' . $filename);
    } else {

        $imageIntervention = Image::make($image);

        if($imageIntervention->width() > 1000){
            $imageIntervention->fit(1000);
        }else{
            $imageIntervention->resize($imageIntervention->width(), $imageIntervention->height());
        }


        if ($old) {
            @unlink($path . '/' . $old);
        }

        $imageIntervention->save($path . '/' . $filename);
    }

    return $filename;
}


function activeMenu($route)
{
    if (request()->routeIs($route)) {
        return 'active';
    }
}


function frontendFormatter($key)
{
    return ucwords(str_replace('_', ' ', $key));
}

function variableReplacer($code, $value, $template)
{
    return str_replace($code, $value, $template);
}

function sendGeneralMail($data){
    $general = GeneralSetting::first();


    if ($general->email_method == 'php') {
        $headers = "From: $general->sitename <$general->email_from> \r\n";
        $headers .= "Reply-To: $general->sitename <$general->email_from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        @mail($data['email'], $data['subject'], $data['message'], $headers);
    }
    else {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $general->smtp_config->smtp_host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $general->smtp_config->smtp_username;
            $mail->Password   = $general->smtp_config->smtp_password;
            if ($general->smtp_config->smtp_encryption == 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            $mail->Port       = $general->smtp_config->smtp_port;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($general->email_from, $general->sitename);
            $mail->addAddress($data['email'], $data['name']);
            $mail->addReplyTo($general->email_from, $general->sitename);
            $mail->isHTML(true);
            $mail->Subject = $data['subject'];
            $mail->Body    = $data['message'];
            $mail->send();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}

function sendMail($key, array $data, $user)
{

    $general = GeneralSetting::first();

    $template =  EmailTemplate::where('name', $key)->first();

    $message = variableReplacer('{username}', $user->username, $template->template);
    $message = variableReplacer('{sent_from}', @$general->sitename, $message);

    foreach ($data as $key => $value) {
        $message = variableReplacer("{" . $key . "}", $value, $message);
    }

    if ($general->email_method == 'php') {
        $headers = "From: $general->sitename <$general->email_from> \r\n";
        $headers .= "Reply-To: $general->sitename <$general->email_from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        @mail($user->email, $template->subject, $message, $headers);
    } else {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $general->smtp_config->smtp_host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $general->smtp_config->smtp_username;
            $mail->Password   = $general->smtp_config->smtp_password;
            if ($general->smtp_config->smtp_encryption == 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            $mail->Port       = $general->smtp_config->smtp_port;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($general->email_from, $general->sitename);
            $mail->addAddress($user->email, $user->username);
            $mail->addReplyTo($general->email_from, $general->sitename);
            $mail->isHTML(true);
            $mail->Subject = $template->subject;
            $mail->Body    = $message;
            $mail->send();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}

function content($key)
{
    return SectionData::where('key', $key)->first();
}

function element($key, $take = 10)
{
    return SectionData::where('key', $key)->take($take)->get();
}


function filePath($folder_name)
{
    return public_path('backend/images/'.$folder_name);
}

function getFile($folder_name, $filename)
{

    return asset('backend/images/'.$folder_name.'/'.$filename);
}

function make_clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 }

function notificationText($key)
{
    $validation = json_decode(file_get_contents(resource_path('lang/validation.json')),true);

    if(array_key_exists($key,$validation)){
        return $validation[$key];
    }

    $validation[$key] = $key;

    file_put_contents(resource_path('lang/validation.json'),json_encode($validation));

    return $validation[$key];

}

function changeDynamic($key){

    $website = json_decode(file_get_contents(resource_path('lang/website.json')), true);

    if (array_key_exists($key, $website)) {
        return "{$website[$key]}";
    }

    $key = $key;
    $website[$key] = $key;
    file_put_contents(resource_path('lang/website.json'), json_encode($website));
    return $key;

}
