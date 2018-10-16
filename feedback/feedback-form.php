<style>
	.feedback-msg {
		display: block;
		font-size: 14px;
		font-weight: 500;
	}
	.show-feedback.button-primary {
		display: none;
		margin: 13px 0;
	}
	.feedback-spinner {
		display: inline-block;
		vertical-align: middle;
		margin: -1px -5px 0 5px;
	}
	#circularG{
		display: none;
		position:relative;
		width:18px;
		height:18px;
		margin: auto;
	}

	.circularG{
		position:absolute;
		background-color:rgb(255,255,255);
		width:4px;
		height:4px;
		border-radius:3px;
			-o-border-radius:3px;
			-ms-border-radius:3px;
			-webkit-border-radius:3px;
			-moz-border-radius:3px;
		animation-name:bounce_circularG;
			-o-animation-name:bounce_circularG;
			-ms-animation-name:bounce_circularG;
			-webkit-animation-name:bounce_circularG;
			-moz-animation-name:bounce_circularG;
		animation-duration:1.1s;
			-o-animation-duration:1.1s;
			-ms-animation-duration:1.1s;
			-webkit-animation-duration:1.1s;
			-moz-animation-duration:1.1s;
		animation-iteration-count:infinite;
			-o-animation-iteration-count:infinite;
			-ms-animation-iteration-count:infinite;
			-webkit-animation-iteration-count:infinite;
			-moz-animation-iteration-count:infinite;
		animation-direction:normal;
			-o-animation-direction:normal;
			-ms-animation-direction:normal;
			-webkit-animation-direction:normal;
			-moz-animation-direction:normal;
	}

	#circularG_1{
		left:0;
		top:7px;
		animation-delay:0.41s;
			-o-animation-delay:0.41s;
			-ms-animation-delay:0.41s;
			-webkit-animation-delay:0.41s;
			-moz-animation-delay:0.41s;
	}

	#circularG_2{
		left:2px;
		top:2px;
		animation-delay:0.55s;
			-o-animation-delay:0.55s;
			-ms-animation-delay:0.55s;
			-webkit-animation-delay:0.55s;
			-moz-animation-delay:0.55s;
	}

	#circularG_3{
		top:0;
		left:7px;
		animation-delay:0.69s;
			-o-animation-delay:0.69s;
			-ms-animation-delay:0.69s;
			-webkit-animation-delay:0.69s;
			-moz-animation-delay:0.69s;
	}

	#circularG_4{
		right:2px;
		top:2px;
		animation-delay:0.83s;
			-o-animation-delay:0.83s;
			-ms-animation-delay:0.83s;
			-webkit-animation-delay:0.83s;
			-moz-animation-delay:0.83s;
	}

	#circularG_5{
		right:0;
		top:7px;
		animation-delay:0.97s;
			-o-animation-delay:0.97s;
			-ms-animation-delay:0.97s;
			-webkit-animation-delay:0.97s;
			-moz-animation-delay:0.97s;
	}

	#circularG_6{
		right:2px;
		bottom:2px;
		animation-delay:1.1s;
			-o-animation-delay:1.1s;
			-ms-animation-delay:1.1s;
			-webkit-animation-delay:1.1s;
			-moz-animation-delay:1.1s;
	}

	#circularG_7{
		left:7px;
		bottom:0;
		animation-delay:1.24s;
			-o-animation-delay:1.24s;
			-ms-animation-delay:1.24s;
			-webkit-animation-delay:1.24s;
			-moz-animation-delay:1.24s;
	}

	#circularG_8{
		left:2px;
		bottom:2px;
		animation-delay:1.38s;
			-o-animation-delay:1.38s;
			-ms-animation-delay:1.38s;
			-webkit-animation-delay:1.38s;
			-moz-animation-delay:1.38s;
	}



	@keyframes bounce_circularG{
		0%{
			transform:scale(1);
		}

		100%{
			transform:scale(.3);
		}
	}

	@-o-keyframes bounce_circularG{
		0%{
			-o-transform:scale(1);
		}

		100%{
			-o-transform:scale(.3);
		}
	}

	@-ms-keyframes bounce_circularG{
		0%{
			-ms-transform:scale(1);
		}

		100%{
			-ms-transform:scale(.3);
		}
	}

	@-webkit-keyframes bounce_circularG{
		0%{
			-webkit-transform:scale(1);
		}

		100%{
			-webkit-transform:scale(.3);
		}
	}

	@-moz-keyframes bounce_circularG{
		0%{
			-moz-transform:scale(1);
		}

		100%{
			-moz-transform:scale(.3);
		}
	}

</style>

<div class="feedback-msg"></div>

	<button class="button button-primary button-large show-feedback"><?php _e( 'Enviar novo feedback', 'cfa' ); ?></button>

<form action="" class="feedback-form">

	<p><?php _e( 'Sua opinião é muito importante para nós! Preencha o formulário abaixo e conte-nos sobre a sua experiência usando a plataforma ConverteFácil.', 'cfa' ); ?></p>
	<p>
		<label for="name"><?php _e( 'Nome', 'cfa' ); ?></label>
		<br />
		<input type="text" name="name" class="regular-text" required />
	</p>
	<p>
		<label for="email"><?php _e( 'Email', 'cfa' ); ?></label>
		<br />
		<input type="email" name="email" class="regular-text" required />
	</p>
	<p>
		<label for="msg"><?php _e( 'Mensagem', 'cfa' ); ?></label>
		<br />
		<textarea name="msg" cols="30" rows="5" class="regular-text" required></textarea>
	</p>
	<p>
		<button class="button button-primary button-large">
			<?php _e( 'Enviar', 'cfa' ); ?>
			<div class="feedback-spinner">
				<div id="circularG">
					<div id="circularG_1" class="circularG"></div>
					<div id="circularG_2" class="circularG"></div>
					<div id="circularG_3" class="circularG"></div>
					<div id="circularG_4" class="circularG"></div>
					<div id="circularG_5" class="circularG"></div>
					<div id="circularG_6" class="circularG"></div>
					<div id="circularG_7" class="circularG"></div>
					<div id="circularG_8" class="circularG"></div>
				</div>
			</div>
		</button>
	</p>
</form>

<script>
	jQuery( function( $ ) {
		$('.feedback-form').each(function(){
			var form = $(this);
			form.submit(function(e){
				e.preventDefault();
				var name = form.find('input[name="name"]').val();
				var email = form.find('input[name="email"]').val();
				var msg = form.find('textarea[name="msg"]').val();
				$( '.feedback-msg' ).html( '' );
				$( '#circularG' ).show();
				jQuery.ajax({
					type: "POST",
					url: ajaxurl,
					data: { action: 'feedback_response' , name: name, email: email, msg: msg }
				}).done(function( data ) {
					$( '#circularG' ).hide();
					if( data.status == 'sent' ) {
						$( '.feedback-form' ).hide();
						form.find('input[name="name"]').val('');
						form.find('input[name="email"]').val('');
						form.find('textarea[name="msg"]').val('');
						form.prev('.show-feedback').show();
					} else {
						console.log( 'Status: ' + data.status );
					}
					$( '.feedback-msg' ).html( '<p>' + data.response + '</p>' );
				});
			});
		});
		$('.show-feedback').click(function(e){
			e.preventDefault();
			$(this).hide().next('.feedback-form').show();
			$( '.feedback-msg' ).text( '' );
		}); // $(.show-feedback).click
	});
</script>