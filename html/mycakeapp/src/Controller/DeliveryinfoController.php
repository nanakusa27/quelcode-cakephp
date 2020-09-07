<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Deliveryinfo Controller
 *
 * @property \App\Model\Table\DeliveryinfoTable $Deliveryinfo
 *
 * @method \App\Model\Entity\Deliveryinfo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliveryinfoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bidinfos'],
        ];
        $deliveryinfo = $this->paginate($this->Deliveryinfo);

        $this->set(compact('deliveryinfo'));
    }

    /**
     * View method
     *
     * @param string|null $id Deliveryinfo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deliveryinfo = $this->Deliveryinfo->get($id, [
            'contain' => ['Bidinfos', 'Ratings'],
        ]);

        $this->set('deliveryinfo', $deliveryinfo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deliveryinfo = $this->Deliveryinfo->newEntity();
        if ($this->request->is('post')) {
            $deliveryinfo = $this->Deliveryinfo->patchEntity($deliveryinfo, $this->request->getData());
            if ($this->Deliveryinfo->save($deliveryinfo)) {
                $this->Flash->success(__('The deliveryinfo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deliveryinfo could not be saved. Please, try again.'));
        }
        $bidinfos = $this->Deliveryinfo->Bidinfos->find('list', ['limit' => 200]);
        $this->set(compact('deliveryinfo', 'bidinfos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Deliveryinfo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deliveryinfo = $this->Deliveryinfo->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deliveryinfo = $this->Deliveryinfo->patchEntity($deliveryinfo, $this->request->getData());
            if ($this->Deliveryinfo->save($deliveryinfo)) {
                $this->Flash->success(__('The deliveryinfo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deliveryinfo could not be saved. Please, try again.'));
        }
        $bidinfos = $this->Deliveryinfo->Bidinfos->find('list', ['limit' => 200]);
        $this->set(compact('deliveryinfo', 'bidinfos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Deliveryinfo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deliveryinfo = $this->Deliveryinfo->get($id);
        if ($this->Deliveryinfo->delete($deliveryinfo)) {
            $this->Flash->success(__('The deliveryinfo has been deleted.'));
        } else {
            $this->Flash->error(__('The deliveryinfo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
