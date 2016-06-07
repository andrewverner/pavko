<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Verner
 * Date: 17.10.14
 * Time: 11:09
 * To change this template use File | Settings | File Templates.
 */

class Emailer extends CComponent {

    private $_to = false;
    private $_from = false;
    private $_subject = false;
    private $_message = false;
    private $_msg = false;
    private $_files = false;
    private $_path = false;
    private $_headers = false;
    private $_html = false;
    private $_attach = false;

    public function init() {

    }

    /**
     * Setting files array<br/>
     * Ex: array('img1.jpg','img2.jpg');
     *
     * @param array $files Files array
     * @return \CEmail
     */

    public function attach($files) {
        $this->_files = $files;
        $this->_attach = true;
        return $this;
    }

    /**
     * Setting the destination email address
     *
     * @param string $to Destination email address
     * @return \CEmail
     */

    public function to($to) {
        $this->_to = $to;
        return $this;
    }

    /**
     * Setting the address of the sender
     *
     * @param string $from Email address of the sender
     * @return \CEmail
     */

    public function from($from) {
        $this->_from = $from;
        return $this;
    }

    /**
     * Setting the subject line
     *
     * @param string $subject Subject of the letter
     * @return \CEmail
     */

    public function subject($subject) {
        $this->_subject = $subject;
        return $this;
    }

    /**
     * Setting message text
     *
     * @param string $message Message text
     * @return \CEmail
     */

    public function message($message) {
        $this->_msg = $message;
        return $this;
    }

    /**
     * Setting HTML-mode
     *
     * @param boolean $boolean HTML-mode
     * @return \CEmail
     */

    public function html($boolean) {
        $this->_html = $boolean;
        return $this;
    }

    /**
     * Setting path to files
     *
     * @param string $path Path
     * @return \CEmail
     */

    public function path($path) {
        $this->_path = $path;
        return $this;
    }

    /**
     * Sending an email
     *
     * @return boolean Send result
     */

    public function send() {
        if ($this->_attach) {
            $this->_headers = "From: $this->_from";
            $semi_rand = md5(time());
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
            $this->_headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
            $this->_message = "\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $this->_msg . "\n\n";
            $this->_message .= "--{$mime_boundary}\n";
            for($x=0;$x<count($this->_files);$x++){
                $filename = $this->_files[$x];
                $file = fopen($this->_path . $this->_files[$x],"rb");
                $data = fread($file,filesize($this->_path . $this->_files[$x]));
                fclose($file);
                $data = chunk_split(base64_encode($data));
                $this->_message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$filename\"\n" .
                    "Content-Disposition: attachment;\n" . " filename=\"$filename\"\n" .
                    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                $this->_message .= "--{$mime_boundary}\n";
            }
        } else {
            $this->_headers= "MIME-Version: 1.0\r\n";
            if ($this->_html) $this->_headers .= "Content-type: text/html; charset=utf-8\r\n";
            $this->_headers .= "From: $this->_from\r\n";
            $this->_message = $this->_msg;
        }
        return mail($this->_to,$this->_subject,$this->_message,$this->_headers);
    }

    /**
     * Validate destination email address
     *
     * @return boolean Validation result
     */

    public function validate() {
        if (filter_var($this->_to,FILTER_VALIDATE_EMAIL)) {
            if ($this->_to) {
                $mx = dns_get_record(end(explode("@",$this->_to)),DNS_MX);
                $mx = $mx[0]['target'];
                $socket = @fsockopen($mx,25,$errno,$errstr,10);
                if (!$socket) return false; else {
                    $this->_sWrite( $socket,"");
                    $this->_sWrite( $socket,"HELO example.com\r\n");
                    $this->_sWrite( $socket,"MAIL FROM: dummy@example.com\r\n");
                    $response = $this->_sWrite( $socket,"RCPT TO: $this->_to\r\n");
                    $this->_sWrite( $socket, "QUIT\r\n" );
                    fclose( $socket );
                    if (substr_count($response,"550") > 0) return false; else
                        if(substr_count($response,"250") > 0) return true;
                        else
                            return false;
                }
            }
            else
                return false;
        }
        else
            return false;
    }

    public function simpleValidate() {
        if (filter_var($this->_to,FILTER_VALIDATE_EMAIL)) return true; else return false;
    }

    private function _sWrite( $socket, $data, $echo = true ){
        fputs( $socket, $data );
        $answer = fread( $socket, 1 );
        $remains = socket_get_status( $socket );
        if( $remains --> 0 ) $answer .= fread( $socket, $remains['unread_bytes'] );
        return $answer;
    }

    public function style() {
        $this->_msg = <<<HTML
<div style="width:100%;background:#eeeeee;">
    <div style="margin: auto; width: 700px; padding: 50px 30px;background-color: #ffffff;">
        <table style="width:100%;border-collapse:collapse;">
            <tr>
                <td style="width:420px;">
                    <a href="http://nazapaske.ru/"><img src="http://nazapaske.ru/images/logo.png" /></a>
                </td>
                <td style="width:220px;text-align: right;vertical-align: middle;">
                    8 (800) 550-76-10<br />
                    8 (863) 275-76-10<br /><br />
                    344091 г.Ростов-на-Дону, ул.Краснодарская 2-я, дом 80/14
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:15px 0;">
                    $this->_msg
                </td>
            </tr>
        </table>
    </div>
</div>
HTML;
        return $this;
    }

}