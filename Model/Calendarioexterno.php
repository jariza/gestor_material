<?php
require_once(APPLIBS.'google-api-php-client-master/src/Google/autoload.php');

class Calendarioexterno extends AppModel {	
	public $useTable = false;
	
	private function _GC_getService() {
		$client = new Google_Client();
		$client->setApplicationName("Client_Gestion_Material_Eventos");
		$creds = new Google_Auth_AssertionCredentials(
			Configure::read('GC_email'),
			array('https://www.googleapis.com/auth/calendar'),
			file_get_contents(APP.Configure::read('GC_keyfile'))
		);
		$client->setAssertionCredentials($creds);
		if($client->getAuth()->isAccessTokenExpired()) {
			$client->getAuth()->refreshTokenWithAssertion($creds);
		}
		$service = new Google_Service_Calendar($client);
		return $service;
	}
	
	private function _GC_getCalendarList($service) {
		$calendarios = array();
		$calendarList = $service->calendarList->listCalendarList();
		while(true) {
			foreach ($calendarList->getItems() as $calendarListEntry) {
				$calendarios[$calendarListEntry->id] = $calendarListEntry->getSummary();
			}
			$pageToken = $calendarList->getNextPageToken();
			if ($pageToken) {
				$calendarList = $service->calendarList->listCalendarList(array('pageToken' => $pageToken));
			} else {
				break;
			}
		}
		
		return $calendarios;
	}
	
	private function _GC_getEventlist($service, $calendarid) {
		$salida = array();
		$horarioevento = Configure::read('datosevento.horario');
		$timezone = date('P');
		$diainicio = min(array_keys($horarioevento));
		foreach ($service->events->listEvents($calendarid, array('timeMin' => $diainicio.'T'.$horarioevento[$diainicio]['inicio'].':00'.$timezone))->getItems() as $event) {
			$salida[$event->getId()]['nombre'] = $event->getSummary();
			//Inicio
			if (!is_null($event->getStart()->getDate())) {
				//Día completo
				if (array_key_exists($event->getStart()->getDate(), $horarioevento)) {
					$horainicio = $horarioevento[$event->getStart()->getDate()]['inicio'];
				}
				else {
					$horainicio = '00:00';
				}
				$salida[$event->getId()]['inicio'] = $event->getStart()->getDate().' '.$horainicio.':00';
			}
			else {
				$salida[$event->getId()]['inicio'] = date('Y-m-d H:i:s', strtotime($event->getStart()->getDateTime()));
			}
			//Final
			if (!is_null($event->getEnd()->getDate())) {
				//Día completo
				if (array_key_exists($event->getEnd()->getDate(), $horarioevento)) {
					$horafin = $horarioevento[$event->getEnd()->getDate()]['fin'];
				}
				else {
					$horafin = '00:00';
				}
				$salida[$event->getId()]['fin'] = $event->getEnd()->getDate().' '.$horafin.':00';
			}
			else {
				$salida[$event->getId()]['fin'] = date('Y-m-d H:i:s', strtotime($event->getEnd()->getDateTime()));
			}
		}
		return $salida;
	}

	public function listacalendarios() {
		if (Configure::check('GC_email') && Configure::check('GC_keyfile')) {
			//Google Calendar
			$gccals = $this->_GC_getCalendarList($this->_GC_getService());
			return array_merge($gccals, array('0' => 'Ninguno'));
		}
		else {
			//Sin calendario externo
			return array();
		}
	}
	
	public function listaeventos($idcalendario) {
		if (Configure::check('GC_email') && Configure::check('GC_keyfile')) {
			//Google Calendar
			$horario = Configure::read('datosevento.horario');
			$temp = array();
			foreach ($horario as $k => $v) {
				$temp[$k] = strtotime($k);
			}
			return $this->_GC_getEventlist($this->_GC_getService(), $idcalendario);
		}
		else {
			//Sin calendario externo
			return array();
		}
	}

}
