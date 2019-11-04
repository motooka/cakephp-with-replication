<?php
namespace App\Model\Behavior;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Behavior;

class ReplicaConnectableBehavior extends Behavior
{
    /**
     * change the connection to the master, which is the default one
     * DO NOT call this inside a transaction
     */
    public function changeConnectionToMaster()
    {
        $masterConnection = ConnectionManager::get('default');
        $this->_table->setConnection($masterConnection);
        //$this->_connection = $masterConnection; // if you implement the same feature in Table subclasses, use this.
    }
    
    /**
     * change the connection to the replica
     * DO NOT call this inside a transaction
     */
    public function changeConnectionToReadReplica()
    {
        $readReplicaConnection = ConnectionManager::get('readonly');
        $this->_table->setConnection($readReplicaConnection);
        //$this->_connection = $readReplicaConnection; // if you implement the same feature in Table subclasses, use this.
    }
    
}
