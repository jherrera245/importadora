<?php

namespace app\modules\inventario\models;

use app\models\Usuarios;
use app\modules\productos\models\Productos;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;

/**
 * This is the model class for table "tbl_inventario".
 *
 * @property int $id_inventario
 * @property string $uuid
 * @property int $id_producto
 * @property int $existencia
 * @property int $existencia_original
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 *
 * @property Productos $producto
 * @property Usuarios $usuarioIng
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_inventario';
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute'=>'fecha_ing',
                'updatedAtAttribute'=> false,
                'value'=> date('Y-m-d H:i:s')
            ],
            [
                'class' =>BlameableBehavior::class,
                'createdByAttribute'=>'id_usuario_ing',
                'updatedByAttribute'=> false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'id_producto', 'existencia', 'existencia_original'], 'required'],
            [['id_producto', 'existencia', 'existencia_original', 'id_usuario_ing'], 'integer'],
            [['fecha_ing'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['id_producto' => 'id_producto']],
            [['id_usuario_ing'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_ing' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_inventario' => 'Codigo',
            'uuid' => 'Uuid',
            'id_producto' => 'Producto',
            'existencia' => 'Existencia',
            'existencia_original' => 'Existencia Original',
            'fecha_ing' => 'Fecha Entrada/Salida',
            'id_usuario_ing' => 'Id Usuario Ing',
        ];
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::class, ['id_producto' => 'id_producto']);
    }

    /**
     * Gets query for [[UsuarioIng]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIng()
    {
        return $this->hasOne(Usuarios::class, ['id_usuario' => 'id_usuario_ing']);
    }
}
