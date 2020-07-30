<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Deliveryinfo Entity
 *
 * @property int $id
 * @property int $bidinfo_id
 * @property string $destination
 * @property string $receiver_name
 * @property string $receiver_tel
 * @property bool $is_sent
 * @property bool $is_received
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Bidinfo $bidinfo
 * @property \App\Model\Entity\Rating[] $ratings
 */
class Deliveryinfo extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'bidinfo_id' => true,
        'destination' => true,
        'receiver_name' => true,
        'receiver_tel' => true,
        'is_sent' => true,
        'is_received' => true,
        'created' => true,
        'modified' => true,
        'bidinfo' => true,
        'ratings' => true,
    ];
}
