<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rating Entity
 *
 * @property int $id
 * @property int $target_user_id
 * @property int $reviewer_user_id
 * @property int $deliveryinfo_id
 * @property int $rating
 * @property string $comment
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\TargetUser $target_user
 * @property \App\Model\Entity\ReviewerUser $reviewer_user
 * @property \App\Model\Entity\Deliveryinfo $deliveryinfo
 */
class Rating extends Entity
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
        'target_user_id' => true,
        'reviewer_user_id' => true,
        'deliveryinfo_id' => true,
        'rating' => true,
        'comment' => true,
        'created' => true,
        'modified' => true,
        'target_user' => true,
        'reviewer_user' => true,
        'deliveryinfo' => true,
    ];
}
