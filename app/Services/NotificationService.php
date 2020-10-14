<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 6/19/20
 * Time: 09:32
 */

namespace App\Services;


use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use \Kreait\Firebase\Database;
use Google\Cloud\Firestore\FirestoreClient;
class NotificationService
{
    public function pushNotification($notifyContent){
        $collection = $this->getConnectFireBase();
        foreach ($notifyContent as $cursor){
            $collection->add($cursor);
        }
    }

    public function pushNotificationStoreUpdate($notifyContent){
        $collection = $this->getConnectFireBase();
        foreach ($notifyContent as $cursor){
            $collection->add($cursor);
        }
    }

    public function getUserNotifications($userId){
        $collection = $this->getConnectFireBase();
        $query = $collection->where('recceive_user_id', '=', $userId)
                        ->limit(100);
        return $query->documents();
    }

    private function getConnectFireBase()
    {
        $firestore = $this->getFirestoreConnect();
        $collection = $firestore->collection(config('common.firestore_notification_collection'));
        return $collection;
    }
    private function getFirestoreConnect(){
        $serviceAccount = ServiceAccount::fromJsonFile(storage_path('app/firebase-config/firebase_credentials.json'));
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount);
        return (new FirestoreClient([
            'projectId' => env('FIREBASE_NOTIFICATION_PROJECT_ID'),
        ]));
    }
}