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
 * @property float|null $gastos_transporte
 * @property float|null $otros_gastos
 * @property string|null $detalle_otros_gastos
 * @property float|null $valor_aduana
 * @property float|null $dai
 * @property float|null $apm
 * @property float|null $vts
 * @property float|null $its
 * @property float|null $aiv
 * @property float|null $opm
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
            [['id_compra', 'id_producto', 'cantidad', 'costo', 'descuento', 'uuid'], 'required'],
            [['id_compra', 'id_producto', 'cantidad', 'id_usuario_ing', 'id_usuario_mod'], 'integer'],
            [['costo', 'descuento', 'gastos_transporte', 'otros_gastos', 'valor_aduana', 'dai', 'apm', 'vts', 'its', 'aiv', 'opm'], 'number'],
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
            'id_det_compra' => 'Id Det Compra',
            'id_compra' => 'Id Compra',
            'id_producto' => 'Id Producto',
            'cantidad' => 'Cantidad',
            'costo' => 'Costo',
            'descuento' => 'Descuento',
            'gastos_transporte' => 'Gastos Transporte',
            'otros_gastos' => 'Otros Gastos',
            'detalle_otros_gastos' => 'Detalle Otros Gastos',
            'valor_aduana' => 'Valor Aduana',
            'dai' => 'Dai',
            'apm' => 'Apm',
            'vts' => 'Vts',
            'its' => 'Its',
            'aiv' => 'Aiv',
            'opm' => 'Opm',
            'uuid' => 'Uuid',
            'fecha_ing' => 'Fecha Ing',
            'id_usuario_ing' => 'Id Usuario Ing',
            'fecha_mod' => 'Fecha Mod',
            'id_usuario_mod' => 'Id Usuario Mod',
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
