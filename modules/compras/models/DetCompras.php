<?php

namespace app\modules\compras\models;

use Yii;
use app\models\Usuarios;
use app\modules\productos\models\Productos;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tbl_det_compras".
 *
 * @property int $id_det_compra
 * @property int $id_compra
 * @property int $id_producto
 * @property int $cantidad
 * @property float $costo
 * @property float $descuento
 * @property string $uuid
 * @property string|null $fecha_ing
 * @property int|null $id_usuario_ing
 * @property string|null $fecha_mod
 * @property int|null $id_usuario_mod
 *
 * @property Compras $compra
 * @property Productos $producto
 * @property Usuarios $usuarioIng
 * @property Usuarios $usuarioMod
 */
class DetCompras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_det_compras';
    }

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
            [['id_compra', 'id_producto', 'cantidad', 'costo', 'descuento', 'valor_aduana', 'uuid'], 'required'],
            [['id_compra', 'id_producto', 'cantidad', 'id_usuario_ing', 'id_usuario_mod'], 'integer'],
            [['costo', 'descuento', 'gastos_transporte', 'otros_gastos', 'valor_aduana', 'dai' , 'apm', 'vts', 'its', 'aiv', 'opm'], 'number'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['detalle_otros_gastos'], 'string', 'max' => 150],
            [['uuid'], 'string', 'max' => 36],
            [['id_compra'], 'exist', 'skipOnError' => true, 'targetClass' => Compras::class, 'targetAttribute' => ['id_compra' => 'id_compra']],
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
            'id_det_compra' => 'Id',
            'id_compra' => 'Compra',
            'id_producto' => 'Producto',
            'cantidad' => 'Cantidad',
            'costo' => 'Costo',
            'descuento' => 'Descuento',
            'gastos_transporte' => 'Gastos en transporte',
            'otros_gastos' => 'Otros gastos',
            'detalle_otros_gastos' => 'Detalle de otros gastos',
            'valor_aduana' => 'Valor en aduana',
            'dai' => 'DAI',
            'apm' => 'APM',
            'vts' => 'VTS',
            'its' => 'ITS',
            'aiv' => 'AIV',
            'opm' => 'OPM',
            'uuid' => 'Uuid',
            'fecha_ing' => 'Fecha Ingreso',
            'id_usuario_ing' => 'Registrado por',
            'fecha_mod' => 'Fecha Modificación',
            'id_usuario_mod' => 'Modificado por',
        ];
    }

    /**
     * Gets query for [[Compra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompra()
    {
        return $this->hasOne(Compras::class, ['id_compra' => 'id_compra']);
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
