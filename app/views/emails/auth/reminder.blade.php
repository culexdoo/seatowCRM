<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" style="font-size: 87.5%;">
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #ffffff;">
		<table cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;">
			<thead>
				<tr>
					<th style="text-align: center; background-color: #e0e0e0; border: 1px solid #d0d0d0; padding: 10px;">
						<img src="{{ url('/') }}/img/emails/header-logo.png" alt="{{ Lang::get('core.cityhub') }}" style="margin-bottom: 10px;"><br><span style="font-size: 1.286rem;">{{ Lang::get('emails.reset_password_title') }}</span>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="border-left: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0; border-bottom: 1px solid #d0d0d0; padding: 20px 10px; text-align: center;">
						{{ Lang::get('emails.reset_password_form') }}:
						<br>
						<a href="{{ URL::route('getResetPassword', array($token)) }}" target="_blank" style="display: inline-block; margin: 20px 0; padding: 15px 25px; background-color: #d81f00; border-radius: 10px; color: #ffffff; text-decoration: none; font-weight: bold;">{{ Lang::get('core.cityhub') }}</a>
						<br>
						{{ Lang::get('emails.reset_password_expiry', array('number' => Config::get('auth.reminder.expire', 60))) }}.
					</td>
				</tr>
				<tr>
					<td>
						
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
