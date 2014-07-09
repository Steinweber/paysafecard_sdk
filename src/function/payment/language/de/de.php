<?php
//validation
$_['username_empty'] = 'Benutzername ist leer!';
$_['username_length'] = 'Der Benutzername muss mehr als 3 Zeichen haben.';
$_['password_empty'] = 'Das Passwort ist leer!';
$_['passwor_length'] = 'Das Passwort muss mehr als 5 Zeichen haben.';
$_['invalid_client_id'] = 'Die angegebene Merchant-Client-ID ist ungültig. Die Merchant-Client-ID muss zwischen 1 und 50 Zeichen lang sein. Erlaubte Zeichen: AZ, az, 0-9 sowie - (Bindestrich) und _ (Unterstrich).';
$_['shopid_oversize'] = 'ShopId ist ungültig. Die ShopId darf nicht mehr als 60 Zeichen haben.';
$_['shopid_undersize'] = 'ShopId ist ungültig. Die ShopId muss mehr als 20 Zeichen haben.';
$_['shopid_invalid'] = 'Die Shop-ID ist ungültig. Erlaubte Zeichen A-Z, a-z, 0-9 und – (Bindestrich) und _ (Unterstrich).';
$_['shoplabel_oversize'] = 'Shoplabel ist ungültig. Shoplabel darf nicht mehr als 60 Zeichen haben.';
$_['shoplabel_undersize'] = 'Shoplabel ist ungültig. Shoplabel muss mehr als 1 Zeichen haben.';
$_['shoplabel_invalid'] = 'Shoplabel ist ungültig. Erlaubte Zeichen A-Z, a-z, 0-9 und – (Bindestrich) und _ (Unterstrich).';
$_['mtid_oversize'] = 'Mtid ist ungültig. Mtid darf nicht mehr als 60 Zeichen haben.';
$_['mtid_undersize'] = 'Mtid ist ungültig. Mtid muss mehr als 20 Zeichen haben.';
$_['mtid_invalid'] = 'Mtid ist ungültig. Erlaubte Zeichen A-Z, a-z, 0-9 und – (Bindestrich) und _ (Unterstrich).';
$_['error_validation_value'] = 'Fehler bei der Validierung. Es wurde kein Wert zur Validierung übergeben!';
$_['error_validation_type'] = 'Fehler bei der Validierung. Es wurde kein gültiger Typ zur Validierung angegeben!';
$_['error_validation'] = 'Fehler bei der Validierung.';
$_['min_age_invalide'] = 'Ungültige Altersbeschränkung. Das Alter muss ein positiver Zahlenwert sein.';
$_['min_kyc_level_invalide'] = 'Ungültige Einschränkung. Das Level muss SIMPLE oder FULL sein.';
$_['restricted_country_invalide'] = 'Invalid restricted country. 2 characters required. The value accepts ISO 3166-1 country codes.';
$_['restricted_country_case'] = 'Ungültige Ländereinschränkung. Es sind nur Großbuchstaben erlaubt. Der Wert akzeptiert ISO 3166-1 Ländercodes.';
$_['invalide_status'] = 'Ungültiger Status. Der Status kann "test" order "live" sein.';
$_['no_status'] = 'Es wurde keine Status angegeben.';
$_['wrong_currency'] = 'Ungültige Währung. Die Währung muss 3 Zeichen lange sein (ISO 4217).';
$_['wrong_currency_case'] = 'Ungültige Währung. Die Währung darf nur in Großbuchstaben angegeben werden.';
$_['dot_amount'] = 'Der Betrag muss mit einem Punkt getrennt werden.';
$_['invalid_nok_url'] = 'Die angegebene nok-URL ist ungültig!';
$_['invalid_ok_url'] = 'Die angegebene ok-URL ist ungültig!';
$_['invalid_pn_url'] = 'Die angegebene pn-URL ist ungültig!';
//new
$_['wrong_amount'] = 'Der Betrag ist nicht vollständig oder richtig formatiert';
$_['create_disposition_missing_parameter'] = 'Der Parameter "%s" fehlt oder ist leer';
$_['create_disposition_error'] = 'Es konnte keine Zahlung Transaktion eröffnet werden. resultCode: %s | errorCode: %s';
$_['get_serial_number_error'] = 'getSerialNumbers konnte nicht erfolgreich ausgeführt werden. resultCode: %s | errorCode: %s';
$_['execute_debit_error'] = 'getSerialNumbers konnte nicht erfolgreich ausgeführt werden. resultCode: %s | errorCode: %s';
//Customer MSG
$_['msg_create_disposition'] = 'Bei der Bezahlung ist ein Fehler aufgetreten. Vermutlich ist dies ein temporärer Fehler und die Bezahlung kann durch Neu-Laden der Seite abgeschlossen werden. Falls dieses Problem weiterhin besteht, kontaktieren Sie bitte unseren Support.';
$_['msg_execute_debit'] = 'Die Zahlung konnte nicht abgeschlossen werden. Es besteht ein temporäres Verbindungsproblem. Bitte drücken Sie den „reload“ Botton im Browser oder den folgenden Link um die Zahlung abzuschließen. <a href="%s">Neuladen</a> <br> Falls dieses Problem weiterhin besteht wenden Sie sich bitte an den Support Sie können auf der paysafecard Guthabenübersicht (https://customer.cc.at.paysafecard.com/psccustomer/GetWelcomePanelServlet?language=de) Erfahren wann der reservierte Betrag wieder freigegeben wird.';
$_['payment_invalide'] = 'Der Bezahlvorgang wurde nicht ordnungsgemäß abgeschlossen';
$_['payment_cancelled'] = 'Der Bezahlvorgang wurde auf Ihren Wunsch abgebrochen';
$_['payment_expired'] = 'Das Zeitfenster ist abgelaufen. Bitte starten Sie den Bezahlvorgang erneut.';
$_['payment_unknown_error'] = 'Unbekannter Fehler bei der Zahlung. Bitte starten Sie den Bezahlvorgang erneut. Sollte der Fehler weiter auftreten, wenden Sie sich bitte an unseren Support';
$_['payment_done'] = 'Der Zahlvorgang wurde erfolgreich abgeschlossen.';