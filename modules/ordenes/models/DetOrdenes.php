<?php

namespace app\modules\ordenes\models;

use Yii;
use app\models\Usuarios;
use app\modules\productos\models\Productos;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tbl_det_ordenes".
 *
 * @property int $id_det_orden
 * @property int $id_orden
 * @property int $id_producto
 * @property int $cantidad
 * @property float $precio
 * @property float $descuento
 * @property string $uuid
 * @property string $consumidor_final
 * @property float $credito_fiscal
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 *
 * @property Ordenes $orden
 * @property Productos $producto
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class DetOrdenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_det_ordenes';
    }

    public $existencia;

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute'=>'fecha_ing',
                'updatedAtAttribute'=>'fecha_mod',
                'value'=> date('Y-m-d H:i:s')
            ],
            [
                'class' =>BlameableBehavior::class,
                'createdByAttribute'=>'id_usuario_ing',
                'updatedByAttribute'=>'id_usuario_mod'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_orden', 'id_producto', 'cantidad', 'precio', 'descuento', 'uuid'], 'required'],
            [['id_orden', 'id_producto', 'cantidad', 'id_usuario_ing', 'id_usuario_mod'], 'integer'],
            [['precio', 'descuento', 'credito_fiscal'], 'number'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['consumidor_final'], 'string', 'max' => 100],
            [['id_orden'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenes::class, 'targetAttribute' => ['id_orden' => 'id_orden']],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['id_producto' => 'id_producto']],
            [['id_usuario_ing'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_ing' => 'id_usuario']],
            [['id_usuario_mod'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_mod' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_det_orden' => 'Id',
            'id_orden' => 'Orden',
            'id_producto' => 'Producto',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'descuento' => 'Descuento',
            'uuid' => 'Uuid',
            'credito_fiscal' => 'Credito Fiscal',
            'consumidor_final' => 'Documento de Consumidor Final',
            'fecha_ing' => 'Fecha Ingreso',
            'id_usuario_ing' => 'Registrado por',
            'fecha_mod' => 'Fecha Modificación',
            'id_usuario_mod' => 'Modificado por',
            'existencia' => 'Existencias'
        ];
    }

    /**
     * Gets query for [[Orden]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrden()
    {
        return $this->hasOne(Ordenes::class, ['id_orden' => 'id_orden']);
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

    /**
     * Gets query for [[UsuarioMod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioMod()
    {
        return $this->hasOne(Usuarios::class, ['id_usuario' => 'id_usuario_mod']);
    }
}
