<?php

namespace App\Libraries;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Models\ConnectionsModel;
use App\Models\m_kelolauser;

class Chat implements MessageComponentInterface
{
    protected $clients;
    protected $conModel;
    protected $ticket;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->conModel = new ConnectionsModel();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $uriQuery = $conn->httpRequest->getUri()->getQuery(); // access_token=123123
        $uriQueryArray = explode('=', $uriQuery); //$uriQueryArray[1]

        $userModel = new m_kelolauser();
        $user_id = explode("&", $uriQueryArray[1]);
        $user = $userModel->find($user_id[0]);
        $this->ticket = $uriQueryArray[2];
        $conn->user = $user;
        $this->clients->attach($conn);

        $this->conModel->where('c_user_id', $user['id_user'])->delete();

        $conData = [
            'c_user_id' => $user['id_user'],
            'c_resource_id' => $conn->resourceId,
            'c_name' => $user['username'],
            'c_ticket' => $this->ticket
        ];
        $this->conModel->save($conData);

        $users = $this->conModel->where('c_ticket', $this->ticket)->get()->getResultArray();
        $users = ['users' => $users, 'ticket' => $this->ticket, 'connect' => 'connecting'];

        foreach ($this->clients as $client) {
            $client->send(json_encode($users));
        }

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $data = [
                    'message' => $msg,
                    'author' => $from->user['username'],
                    'time' => date('H:i'),
                    'ticket' => $this->ticket,
                    'connect' => 'sending'
                ];
                $client->send(json_encode($data));
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages        
        $this->clients->detach($conn);

        $this->conModel->where('c_resource_id', $conn->resourceId)->delete();
        $users = $this->conModel->where('c_ticket', $this->ticket)->get()->getResultArray();
        $users = ['users' => $users, 'ticket' => $this->ticket, 'connect' => 'close'];

        foreach ($this->clients as $client) {
            $client->send(json_encode($users));
        }
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
   
}
