<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\network\protocol;

use pocketmine\utils\Binary;











class LoginPacket extends DataPacket{
	const NETWORK_ID = Info::LOGIN_PACKET;

	public $username;
	public $protocol1;
	public $protocol2;
	public $clientId;

	public $slim = \false;
	public $skin = \null;

	public function decode(){
		$this->username = $this->getString();
		$this->protocol1 = \unpack("N", $this->get(4))[1] << 32 >> 32;
		$this->protocol2 = \unpack("N", $this->get(4))[1] << 32 >> 32;
		$this->clientId = \unpack("N", $this->get(4))[1] << 32 >> 32;
		if($this->protocol1 < 21){ //New fields!
			$this->setBuffer(\null, 0); //Skip batch packet handling
			return;
		}
		$this->slim = \ord($this->get(1)) > 0;
		$this->skin = $this->getString();
	}

	public function encode(){

	}

}