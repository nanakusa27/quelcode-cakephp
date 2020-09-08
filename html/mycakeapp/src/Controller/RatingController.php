<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

use Cake\Event\Event; // added.
use Exception; // added.

/**
 * Ratings Controller
 *
 * @property \App\Model\Table\RatingsTable $Ratings
 *
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatingController extends AuctionController
{
    // デフォルトテーブルを使わない
	public $useTable = false;

	// 初期化処理
	public function initialize()
	{
		parent::initialize();
    }

    /**
     * View method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function ratingview()
    {
        $user_id = $this->request->query['user_id'];
        $username = $this->Users->get($user_id)->username;

        $ratings = $this->Ratings->find();

        $rating_avg = $this->Ratings->find()
            ->select(['rating_avg' => $ratings->func()->avg('rating')])
            ->where(['target_user_id' => $user_id])
            ->first();

        $mybiditems = $this->Biditems->find()
        ->select('id')
        ->where(['user_id' => $user_id])
        ->extract('id');
        $items = [];
        foreach($mybiditems as $item){
            $items[] = $item;
        }
        if (!empty($items)) {
            $myitems = $items;

            $bidinfo = $this->Bidinfo->find();
            $total_sold = $this->Bidinfo->find()
                ->select(["price" => $bidinfo->func()->sum('price')])
                ->where(['biditem_id IN' => $myitems])
                ->first();
        }

        $comments = $this->Ratings->find()
            ->select('comment')
            ->where(['target_user_id' => $user_id])
            ->limit(25)
            ->toArray();

        $this->set(compact('rating_avg', 'total_sold', 'comments', 'username'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function ratingadd()
    {
        $deliveryinfo_id = $this->request->query['deliveryinfo_id'];
        $deliveryinfo = $this->Deliveryinfo->get($deliveryinfo_id);
        $bidinfo = $this->Bidinfo->get($deliveryinfo->bidinfo_id);
        $biditem = $this->Biditems->get($bidinfo->biditem_id);

        switch ($this->Auth->user('id'))
        {
            case $bidinfo->user_id:
                $target_user_id = $biditem->user_id;
                break;
            case $biditem->user_id:
                $target_user_id = $bidinfo->user_id;
                break;
        }

        $rating = $this->Ratings->newEntity();
        if ($this->request->is('post')) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success('データを保存しました。');

                return $this->redirect(['controller' => 'Auction', 'action' => 'index']);
            }
            $this->Flash->error('データの保存に失敗しました。');
        }
        $this->set(compact('rating', 'target_user_id', 'deliveryinfo'));
    }

}
