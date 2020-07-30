<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Deliveryinfo Model
 *
 * @property \App\Model\Table\BidinfosTable&\Cake\ORM\Association\BelongsTo $Bidinfos
 * @property \App\Model\Table\RatingsTable&\Cake\ORM\Association\HasMany $Ratings
 *
 * @method \App\Model\Entity\Deliveryinfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Deliveryinfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Deliveryinfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Deliveryinfo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Deliveryinfo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Deliveryinfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Deliveryinfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Deliveryinfo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DeliveryinfoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('deliveryinfo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Bidinfo', [
            'foreignKey' => 'bidinfo_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Ratings', [
            'foreignKey' => 'deliveryinfo_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('destination')
            ->maxLength('destination', 1000)
            ->requirePresence('destination', 'create')
            ->notEmptyString('destination');

        $validator
            ->scalar('receiver_name')
            ->maxLength('receiver_name', 100)
            ->requirePresence('receiver_name', 'create')
            ->notEmptyString('receiver_name');

        $validator
            ->scalar('receiver_tel')
            ->maxLength('receiver_tel', 20)
            ->requirePresence('receiver_tel', 'create')
            ->notEmptyString('receiver_tel');

        $validator
            ->boolean('is_sent')
            ->notEmptyString('is_sent');

        $validator
            ->boolean('is_received')
            ->notEmptyString('is_received');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['bidinfo_id'], 'Bidinfos'));

        return $rules;
    }
}
