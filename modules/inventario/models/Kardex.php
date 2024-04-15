<?php

namespace app\modules\inventario\models;

use app\models\Usuarios;
use app\modules\productos\models\Productos;
use app\modules\compras\models\Compras;
use app\modules\ventas\models\Ventas;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use Yii;

/**
 * This is the model class for table "tbl_kardex".
 *
 * @property int $id_kardex
 * @property int $id_documento
 * @property string $cod_documento
 * @property string $num_documento
 * @property string $tipo_documento
 * @property int $id_producto
 * @property int $cantidad
 * @property string $uuid
 * @property string $fecha_ing
 * @property int $id_usuario_ing
 * @property int|null $id_venta
 * @property int|null $id_compra
 *
 * @property Compras $compra
 * @property Ventas $venta
 * @property Productos $producto
 * @property Usuarios $usuarioIng
 */
class Kardex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kardex';
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
            [['id_documento', 'cod_documento', 'num_documento', 'tipo_documento', 'id_producto', 'cantidad', 'uuid'], 'required'],
            [['id_documento', 'id_producto', 'cantidad', 'id_usuario_ing', 'id_venta', 'id_compra'], 'integer'],
            [['fecha_ing'], 'safe'],
            [['cod_documento', 'num_documento', 'tipo_documento'], 'string', 'max' => 25],
            [['uuid'], 'string', 'max' => 36],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['id_producto' => 'id_producto']],
            [['id_usuario_ing'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario_ing' => 'id_usuario']],
            [['id_venta'], 'exist', 'skipOnError' => true, 'targetClass' => Ventas::class, 'targetAttribute' => ['id_venta' => 'id_venta']],
            [['id_compra'], 'exist', 'skipOnError' => true, 'targetClass' => Compras::class, 'targetAttribute' => ['id_compra' => 'id_compra']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kardex' => 'Id Kardex',
            'id_documento' => 'Id Documento',
            'id_venta' => 'Id venta',
            'id_compra' => 'Id Compra',
            'cod_documento' => 'Cod Documento',
            'num_documento' => 'Num Documento',
            'tipo_documento' => 'Tipo Documento',
            'id_producto' => 'Id Producto',
            'cantidad' => 'Cantidad',
            'uuid' => 'Uuid',
            'fecha_ing' => 'Fecha Ing',
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
     * Gets query for [[Venta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVenta()
    {
        return $this->hasOne(Ventas::class, ['id_venta' => 'id_venta']);
    }
}
