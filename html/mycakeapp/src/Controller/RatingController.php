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

        $rating_avg = 'まだ評価がありません';
        $ratings = $this->Ratings->find();
        $rating_sql = $this->Ratings->find()
            ->select(['rating_avg' => $ratings->func()->avg('rating')])
            ->where(['target_user_id' => $user_id]);
        $raging_avg = $rating_sql->first();

        $comments = $this->Ratings->find()
            ->select('comment')
            ->where(['target_user_id' => $user_id])
            ->limit(25);
        $rating_comments = $comments->first();

        $this->set(compact('rating_avg', 'rating_comments', 'username'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function ratingadd()
    {
        $rating = $this->Ratings->newEntity();
        if ($this->request->is('post')) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success('データを保存しました。');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('データの保存に失敗しました。');
        }
    }

}
