<?php

namespace OutDated;

use pocketmine\plugin\PluginBase; //Always use backslashes for imports
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\protocol\Info; //Needed for ProtocolInfo::
use pocketmine\network\protocol\DataPacket; //Needed for DataPacket
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
class OutDated extends PluginBase implements Listener {

public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info(TextFormat::GREEN . "OutDated 1.0 Enabled!");
                }

public function onDPRPacket(DataPacketReceiveEvent $ev){
        $p = $ev->getPlayer();
        if(($pk = $ev->getPacket()) instanceof DataPacket){
            switch($pk->pid()){
                case ProtocolInfo::LOGIN_PACKET;
                    if($pk->protocol1 === ProtocolInfo::CURRENT_PROTOCOL){
                        return;
                    }
                    if($pk->protocol1 > ProtocolInfo::CURRENT_PROTOCOL){
                        $p->kick("Why are you new with the cool kids? Downgrade your Client!");
                        $ev->setCancelled(true);
                    }else{
                        $p->kick("Dumbo! Update your client. Your old :(");
                        $ev->setCancelled(true);
                    }
                break;
             
                default:
             
                break;
            }
        }
    }
}
