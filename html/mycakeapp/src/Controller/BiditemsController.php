<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Biditems Controller
 *
 * @property \App\Model\Table\BiditemsTable $Biditems
 *
 * @method \App\Model\Entity\Biditem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BiditemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $biditems = $this->paginate($this->Biditems);

        $this->set(compact('biditems'));
    }

    /**
     * View method
     *
     * @param string|null $id Biditem id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $biditem = $this->Biditems->get($id, [
            'contain' => ['Users', 'Bidinfo', 'Bidrequests'],
        ]);

        $this->set('biditem', $biditem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $biditem = $this->Biditems->newEntity();
        if ($this->request->is('post')) {
            $img = $this->request->getData('image_path');
			$biditem = $this->Biditems->patchEntity($biditem, [
				'user_id' => $this->request->getData('user_id'),
				'name' => $this->request->getData('name'),
				'information' => $this->request->getData('information'),
				'image_path' => $img['name'],
				'finished' => $this->request->getData('finished'),
				'endtime' => $this->request->getData('endtime')
			]);
            if ($this->Biditems->save($biditem)) {
                $file_id = $biditem->id;
				$file = new File($biditem['image_path']);
				$ext = $file->ext();
				$file_path = '/img/itemImage/' . $file_id . '.' . $ext;
				$dir = WWW_ROOT . $file_path;
				$data = $this->Biditems->patchEntity($biditem, [
					'image_path' => $file_path
				]);
				$this->Biditems->save($data, false);
				move_uploaded_file($img['tmp_name'], $dir);
                $this->Flash->success(__('The biditem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biditem could not be saved. Please, try again.'));
        }
        $users = $this->Biditems->Users->find('list', ['limit' => 200]);
        $this->set(compact('biditem', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Biditem id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $biditem = $this->Biditems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $img = $this->request->getData('image_path');
			$biditem = $this->Biditems->patchEntity($biditem, [
				'user_id' => $this->request->getData('user_id'),
				'name' => $this->request->getData('name'),
				'information' => $this->request->getData('information'),
				'image_path' => $img['name'],
				'finished' => $this->request->getData('finished'),
				'endtime' => $this->request->getData('endtime')
			]);
            if ($this->Biditems->save($biditem)) {
                $file_id = $biditem->id;
				$file = new File($biditem['image_path']);
				$ext = $file->ext();
				$file_path = '/img/itemImage/' . $file_id . '.' . $ext;
				$dir = WWW_ROOT . $file_path;
				$data = $this->Biditems->patchEntity($biditem, [
					'image_path' => $file_path
				]);
				$this->Biditems->save($data, false);
				move_uploaded_file($img['tmp_name'], $dir);
                $this->Flash->success(__('The biditem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The biditem could not be saved. Please, try again.'));
        }
        $users = $this->Biditems->Users->find('list', ['limit' => 200]);
        $this->set(compact('biditem', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Biditem id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $biditem = $this->Biditems->get($id);
        if ($this->Biditems->delete($biditem)) {
            $this->Flash->success(__('The biditem has been deleted.'));
        } else {
            $this->Flash->error(__('The biditem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
