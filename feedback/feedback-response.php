<?php
add_action( 'wp_ajax_feedback_response', 'cfa_ajax_feedback_response_action' );

function cfa_ajax_feedback_response_action(){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];
    $reponse = array();

    if( !empty( $name ) && !empty( $email ) && !empty( $msg ) ) :

    	if( !filter_var($email, FILTER_VALIDATE_EMAIL ) ) :
        	$response['status'] = 'invalid';
        	$response['response'] = __( 'Email inválido.', 'cfa' );
    	else:
    		$response['status'] = 'valid';
    		$site_name = get_bloginfo( 'name' );
    		$to = 'contato@convertefacil.com.br';
    		// $to = 'ingo@laf.marketing';
    		$subject = __( 'Feedback: ' ) . $site_name;
    		$headers = 'From: ' . $site_name . ' <feedback@' . $_SERVER['SERVER_NAME'] . '>' . "\r\n";
			$headers .= 'Reply-To: ' . $email . "\r\n";
			$headers .= 'Bcc: ingo@laf.marketing' . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=utf-8\r\n";
    		$mail_body = 
    			'<html><body><table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="max-width: 600px;margin: auto;">
    				<tr>
    				  <td style="padding: 20px; font-family: sans-serif; font-size: 16px; line-height: 27px; color: #666666; text-align: right;">Nome:</td>
    				  <td style="padding: 20px; font-family: sans-serif; font-size: 16px; line-height: 27px; color: #666666;">' . $name . '</td>
    				</tr>
    				<tr>
    				  <td style="padding: 20px; font-family: sans-serif; font-size: 16px; line-height: 27px; color: #666666; text-align: right;">Email:</td>
    				  <td style="padding: 20px; font-family: sans-serif; font-size: 16px; line-height: 27px; color: #666666;">' . $email . '</td>
    				</tr>
    				<tr>
    				  <td style="padding: 20px; font-family: sans-serif; font-size: 16px; line-height: 27px; color: #666666; text-align: right;">Mensagem:</td>
    				  <td style="padding: 20px; font-family: sans-serif; font-size: 16px; line-height: 27px; color: #666666;">' . $msg . '</td>
    				</tr>
    			</table></body></html>';
    		$sent = wp_mail( $to, $subject, $mail_body, $headers );
    		if( $sent ) :
    			$response['status'] = 'sent';
    			$response['response'] = __( 'Feedback enviado com sucesso!', 'cfa' );
    		else :
    			$response['status'] = 'fail';
    			$response['response'] = __( 'Ocorreu um erro ao enviar o feedback.', 'cfa' );
    		endif;
    	endif;

    else :
        $response['status'] = 'empty';
     	$response['response'] = __( 'Um dos campos não foi preenchido.', 'cfa' );
    endif;

    header( "Content-Type: application/json" );
    echo json_encode( $response );

    exit();

}